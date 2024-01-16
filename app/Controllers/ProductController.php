<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\MarketModel;
use App\Models\ProductAccessLogModel;
use App\Models\ProductMarket;
use App\Models\ProductModel;
use App\Models\VarianModel;

class ProductController extends BaseController
{
    protected $floorplan;
    protected $product;
    protected $product_market;
    protected $floorproduct;
    protected $varian;
    protected $market;
    protected $productlogs;

    public function __construct()
    {
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
        $this->product = new ProductModel();
        $this->product_market = new ProductMarket();
        $this->varian = new VarianModel();
        $this->market = new MarketModel();
        $this->productlogs = new ProductAccessLogModel();
    }

    public function index()
    {
        helper(['form', 'url']);
        $data['product'] = $this->product->getProductMarkets();
        $data['market'] = $this->market->findAll();
        return view("page/product/table_product", $data);
    }

    public function create()
    {
        $data['product'] = $this->product->getProductMarkets();
        $data['category'] = $this->getCategory();
        $data['market'] = $this->market->findAll();
        $data['floorplan'] = $this->floorplan->findAll();
        return view("page/product/create_product", $data);
    }

    public function edit($id)
    {
        $data['product'] = $this->product->getProductMarketId($id);
        $data['category'] = $this->getCategory();
        $data['market'] = $this->market->findAll();
        $data['floorplan'] = $this->floorplan->findAll();
        $data['floorproduct'] = $this->floorproduct->where('id_product', $id)->find();
        $data['varian'] = $this->varian->where('id_product', $id)->find();
        return view("page/product/edit_product", $data);
    }

    public function store()
    {
        $name_produk = $this->request->getPost('name_product');
        $data = [
            'name_product' => $name_produk,
            'description_product' => $this->request->getPost('description_product'),
            'category' => implode(',', $this->request->getPost('category')),
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
        // dd($data);

        // Save data to the database using the model
        $this->product->insert($data);
        $lastInsertedId = $this->product->insertID();

        // Handle dynamic floor plans
        $varianName = $this->request->getPost('name_varian');
        $varianImages = $this->request->getFileMultiple('picture_varian');
        $varianData = [];

        if ($varianImages) {
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
        }



        $selectedFloorplans = $this->request->getPost('name_floor');
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

        session()->setFlashdata('success', 'Product ' . $name_produk . ' berhasil ditambahkan.');
        return redirect()->to('/products');
    }

    public function update()
    {
        $productId = $this->request->getPost('product_id');
        $name_produk = $this->request->getPost('name_product');
        $data = [
            'id' => $productId,
            'name_product' => $name_produk,
            'description_product' => $this->request->getPost('description_product'),
            'category' => implode(',', $this->request->getPost('category')),
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
        $this->product->update($productId, $data);

        // Redirect or respond as needed
        session()->setFlashdata('success', 'Product ' . $name_produk . ' berhasil diupdate.');
        return redirect()->to('/products');
    }

    function delete($id)
    {
        $dataproduct = $this->product->find($id);
        if (empty($dataproduct)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Product Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = explode(',', $dataproduct->picture_product);
        $dataVarian = $this->varian->where('id_product', $id)->find();

        foreach ($img as $file) {
            $imagePath = './img/' . trim($file);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($dataVarian) {
            $imgPath = './img/' . trim($dataVarian[0]->picture_varian);
            unlink($imgPath);
            $this->varian->where('id_product', $id)->delete();
        }

        $this->floorproduct->where('id_product', $id)->delete();
        $this->productlogs->where('id_product', $id)->delete();
        $this->product_market->where('id_product', $id)->delete();

        $this->product->delete($id);
        session()->setFlashdata('success', 'Product ' . $id . ' berhasil dihapus.');
        return redirect()->to('/products');
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
