<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\ProductModel;
use App\Models\VarianModel;

class ProductApi extends ResourceController
{
    use ResponseTrait;
    protected $floorplan;
    protected $product;
    protected $floorproduct;
    protected $varian;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->form_validation = \Config\Services::validation();
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
        $this->product = new ProductModel();
        $this->varian = new VarianModel();
    }

    public function index()
    {
        $data = $this->product->findAll();
        $category = $this->getCategory();
        $datafull = [
            'Result' => $data,
            'Category' => $category
        ];
        return $this->respond($datafull);
    }

    public function show($id = null)
    {
        $data = $this->product->find($id);

        if ($data) {
            $exploded = explode(',', $data->picture_product);
            $pic = array();
            $j = 1;

            foreach ($exploded as $elem) {
                $pic[] = $elem;
                $j++;
            }

            $response[] = array(
                'id' => $data->id,
                'name_product' => $data->name_product,
                'description_product' => $data->description_product,
                'picture_product' => $pic,
                'asset_url' => $data->asset_url,
                'category' => $data->category,
                'status' => $data->status
            );
        }

        $datafull = [
            'message' => 'Get All Data ' . $id,
            'Result' => $response,
        ];
        return $this->respond($datafull);
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

}
