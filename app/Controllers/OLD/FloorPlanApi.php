<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\ProductModel;
use App\Models\VarianModel;

class FloorPlanApi extends ResourceController
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
        // $categories = $this->product->findAll('category');
        $categories = $this->product->findAll();


        $uniqueCategories = [];
        foreach ($categories as $categoryRow) {
            // Memisahkan kategori jika terdapat koma sebagai pemisah
            $categoryList = explode(',', $categoryRow->category);

            // Menambahkan setiap kategori ke dalam array unik
            $uniqueCategories = array_merge($uniqueCategories, $categoryList);
        }

        // Menghapus duplikat dan mengembalikan array unik
        $uniqueCategories = array_values(array_unique($uniqueCategories));

        // Menyiapkan data untuk respons JSON
        $datafull = ['category' => $uniqueCategories];

        // Memberikan respons JSON
        return $this->respond($datafull);
    }

    public function show($id = null)
    {
        $data = $this->floorplan
            ->where('id_market', $id)
            ->findAll();

        $products = [];

        foreach ($data as $floorPlan) {
            $products[] = $floorPlan->product;
        }

        $responseData = [
            'floorplans' => $data,
            'products' => $products,
        ];

        return $this->respond($responseData);
    }

}
