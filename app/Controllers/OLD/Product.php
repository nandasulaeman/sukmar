<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\MarketModel;
use App\Models\ProductMarket;
use App\Models\ProductModel;
use App\Models\VarianModel;

class Product extends BaseController
{
    protected $floorplan;
    protected $product;
    protected $product_market;
    protected $floorproduct;
    protected $varian;
    protected $market;

    public function __construct()
    {
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
        $this->product = new ProductModel();
        $this->product_market = new ProductMarket();
        $this->varian = new VarianModel();
        $this->market = new MarketModel();
    }

    public function index()
    {
        helper(['form', 'url']);
        $data['product'] = $this->product->findAll();
        $data['market'] = $this->market->findAll();
        return view("page/management_product", $data);
    }

    public function store()
    {
        $data = [
            'name_product' => $this->request->getPost('name_product'),
            'description_product' => $this->request->getPost('description_product'),
            'asset_url' => $this->request->getPost('asset_url'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];

        // Handle multiple images
        $uploadedFiles = $this->request->getFileMultiple('picture_product');
        $imageNames = [];
        foreach ($uploadedFiles as $file) {
            $newName = $file->getRandomName();
            $file->move('./img/', $newName);
            $imageNames[] = $newName;
        }

        $data['picture_product'] = implode(',', $imageNames);

        // Save data to the database using the model
        $this->product->insert($data);
        $lastInsertedId = $this->product->insertID();

        // Handle dynamic floor plans
        $varianName = $this->request->getPost('name_varian');
        $varianImages = $this->request->getFileMultiple('picture_varian');
        $varianData = [];

        foreach ($varianImages as $key => $file) {
            $newName = $file->getRandomName();
            $file->move('./img/', $newName);
            $varianData[] = [
                'name_varian' => $varianName[$key],
                'picture_varian' => $newName,
                'id_product' => $lastInsertedId,
            ];
        }
        $this->varian->insertBatch($varianData);



        $selectedFloorplans = $this->request->getPost('floorplans');
        $floorData = [];

        foreach ($selectedFloorplans as $key => $floors) {
            $floorData[] = [
                'id_floor_plan' => $selectedFloorplans[$key],
                'id_product' => $lastInsertedId,
            ];
        }
        $this->floorproduct->insertBatch($floorData);

        $idMarket = $this->request->getPost('id_market');
        $productMarket = [
            'id_market' => $idMarket,
            'id_product' => $lastInsertedId,
        ];
        $this->product_market->insert($productMarket);

        session()->setFlashdata('message', 'Tambah Data Product Berhasil');
        return redirect()->to('/product');
    }

    public function update()
    {
        $varianId = $this->request->getPost('product_id');
        $data = [
            'id' => $varianId,
            'name_product' => $this->request->getPost('name_product'),
            'description_product' => $this->request->getPost('description_product'),
            'asset_url' => $this->request->getPost('asset_url'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
        ];

        // Get uploaded images
        $uploadedFiles = $this->request->getFileMultiple('picture_product');

        // If there are uploaded images
        if ($uploadedFiles[0]->getName() != "") {
            // Remove old images
            $oldImagesString = $this->request->getPost('imgold');
            $oldImagesArray = explode(',', $oldImagesString);

            foreach ($oldImagesArray as $oldImage) {
                $imagePath = './img/' . trim($oldImage);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $imageNames = [];
            foreach ($uploadedFiles as $file) {
                $newName = $file->getRandomName();
                $file->move('./img/', $newName);
                $imageNames[] = $newName;
            }
            $data['picture_product'] = implode(',', $imageNames);
        }

        // Update data in the database using the model
        $this->product->update($varianId, $data);

        // Redirect or respond as needed
        return redirect()->to('/product');
    }

    function delete($id)
    {
        $dataproduct = $this->product->find($id);
        if (empty($dataproduct)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Product Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = explode(',', $dataproduct->picture_product);

        foreach ($img as $file) {
            $imagePath = './img/' . trim($file);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $this->varian->where('id_product', $id)->delete();

        $this->product->delete($id);
        session()->setFlashdata('message', 'Delete Data Product Berhasil');
        return redirect()->to('/product');
    }

}
