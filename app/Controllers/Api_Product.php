<?php

namespace App\Controllers;

use App\Models\ProductAccessLogModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\ProductModel;
use App\Models\VarianModel;

class Api_Product extends ResourceController
{
    use ResponseTrait;
    protected $floorplan;
    protected $product;
    protected $floorproduct;
    protected $varian;
    protected $accesslogs;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->form_validation = \Config\Services::validation();
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
        $this->product = new ProductModel();
        $this->varian = new VarianModel();
        $this->accesslogs = new ProductAccessLogModel();
    }

    public function index()
    {
        $data = $this->product->getProductAll();
        $floor = $this->floorplan->findAll();

        foreach ($data as &$row) {
            $row = (array) $row; // Convert the object to an array
            $row['category'] = explode(',', $row['category']);
            $row['name_floor'] = explode(',', $row['name_floor']);
            $row['picture_floor'] = explode(',', $row['picture_floor']);
            $row['name_varian'] = explode(',', $row['name_varian']);
            $row['picture_varian'] = explode(',', $row['picture_varian']);
            $row['asset_url'] = array_map('trim', explode(',', $row['asset_url']));
            $row['picture_product'] = array_map('trim', explode(',', $row['picture_product']));

        }

        $floorNames = array_column($floor, 'name_floor'); // Ambil nama floor dari setiap rekaman floor

        $category = $this->getCategory();

        $datafull = [
            'Result' => $data,
            'Categorys' => $category,
            'Floor' => $floorNames // Menggunakan array nama floor
        ];

        return $this->respond($datafull);
    }



    public function show($id = null)
    {
        $data = $this->product->getProductbyID($id);

        $response = [];

        if ($data) {
            $data = (array) $data; // Convert the object to an array

            // Splitting comma-separated values into arrays
            $data['category'] = explode(',', $data['category']);
            $data['name_floor'] = explode(',', $data['name_floor']);
            $data['picture_floor'] = explode(',', $data['picture_floor']);
            $data['name_varian'] = explode(',', $data['name_varian']);
            $data['picture_varian'] = explode(',', $data['picture_varian']);
            $data['asset_url'] = array_map('trim', explode(',', $data['asset_url']));
            $data['picture_product'] = array_map('trim', explode(',', $data['picture_product']));

            $response = [
                'id' => $data['id'],
                'name_product' => $data['name_product'],
                'description_product' => $data['description_product'],
                'picture_product' => $data['picture_product'],
                'category' => $data['category'],
                'status' => $data['status'],
                'name_floor' => $data['name_floor'],
                'picture_floor' => $data['picture_floor'],
                'name_varian' => $data['name_varian'],
                'asset_url' => $data['asset_url'],
                'picture_varian' => $data['picture_varian'],
            ];
            $this->saveAccessLog($id);
        }

        $datafull = [
            'message' => $data ? 'Get All Data Product From ID ' . $id : 'Data not found for ID ' . $id,
            'Result' => $response,
        ];
        return $this->respond($datafull);
    }

    private function saveAccessLog($productId)
    {
        // Cek apakah log sudah ada
        $log = $this->accesslogs->where('id_product', $productId)->first();

        if ($log) {
            // Jika sudah ada, tambahkan 1 ke access_count
            $this->accesslogs->update($log->id, ['access_count' => $log->access_count + 1]);
        } else {
            // Jika belum ada, buat log baru
            $this->accesslogs->insert([
                'access_count' => 1,
                'id_product' => $productId,
            ]);
        }
    }

    public function getCategory()
    {
        $categories = $this->product->findAll();

        $uniqueCategories = [];
        foreach ($categories as $categoryRow) {
            $categoryList = explode(',', $categoryRow->category);
            $uniqueCategories = array_merge($uniqueCategories, $categoryList);
        }

        $uniqueCategories = array_values(array_unique($uniqueCategories));
        $datafull = ['category' => $uniqueCategories];
        // return $this->respond($datafull);

        return $uniqueCategories;
    }

    public function showbyCategory($id = null)
    {
        $data = $this->product->getProductbyCat($id);

        $response = [];

        foreach ($data as $item) {
            $item = (array) $item; // Convert the object to an array
            $item['category'] = explode(',', $item['category']);
            $item['name_floor'] = explode(',', $item['name_floor']);
            $item['picture_floor'] = explode(',', $item['picture_floor']);
            $item['name_varian'] = explode(',', $item['name_varian']);
            $item['asset_url'] = array_map('trim', explode(',', $item['asset_url']));
            $item['picture_varian'] = explode(',', $item['picture_varian']);
            $item['picture_product'] = array_map('trim', explode(',', $item['picture_product']));

            $response[] = [
                'id' => $item['id'],
                'name_product' => $item['name_product'],
                'description_product' => $item['description_product'],
                'picture_product' => $item['picture_product'],
                'category' => $item['category'],
                'status' => $item['status'],
                'name_floor' => $item['name_floor'],
                'picture_floor' => $item['picture_floor'],
                'name_varian' => $item['name_varian'],
                'asset_url' => $item['asset_url'],
                'picture_varian' => $item['picture_varian'],
            ];
        }

        $datafull = [
            'message' => 'Get All Data Product from Category ' . $id,
            'Result' => $response,
        ];

        return $this->respond($datafull);
    }

    public function showbyFloor($id = null)
    {
        $data = $this->product->getProductbyFloor($id);

        $response = [];

        foreach ($data as $item) {
            $item = (array) $item; // Convert the object to an array
            $item['category'] = explode(',', $item['category']);
            $item['name_floor'] = explode(',', $item['name_floor']);
            $item['picture_floor'] = explode(',', $item['picture_floor']);
            $item['name_varian'] = explode(',', $item['name_varian']);
            $item['picture_varian'] = explode(',', $item['picture_varian']);
            $item['asset_url'] = array_map('trim', explode(',', $item['asset_url']));
            $item['picture_product'] = array_map('trim', explode(',', $item['picture_product']));


            $response[] = [
                'id' => $item['id'],
                'name_product' => $item['name_product'],
                'description_product' => $item['description_product'],
                'picture_product' => $item['picture_product'],
                'category' => $item['category'],
                'status' => $item['status'],
                'name_floor' => $item['name_floor'],
                'picture_floor' => $item['picture_floor'],
                'name_varian' => $item['name_varian'],
                'asset_url' => $item['asset_url'],
                'picture_varian' => $item['picture_varian'],
            ];
        }

        $datafull = [
            'message' => 'Get All Data Product from Nama Denah ' . $id,
            'Result' => $response,
        ];

        return $this->respond($datafull);
    }


}
