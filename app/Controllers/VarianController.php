<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\MarketModel;
use App\Models\ProductModel;
use App\Models\VarianModel;

class VarianController extends BaseController
{
    protected $market;
    protected $floorplan;
    protected $varian;
    protected $product;

    public function __construct()
    {
        $this->market = new MarketModel();
        $this->floorplan = new FloorPlanModel();
        $this->varian = new VarianModel();
        $this->product = new ProductModel();
    }

    public function index()
    {
        $data['product'] = $this->product->findAll();
        $data['varian'] = $this->varian->getVarianProduct();
        helper(['form', 'url']);
        return view("page/product varian/table_varian", $data);
    }

    public function create()
    {
        $data['product'] = $this->product->findAll();
        $data['varian'] = $this->varian->findAll();
        return view("page/product varian/create_varian", $data);
    }

    public function edit($id)
    {
        $data['product'] = $this->product->findAll();
        $data['varian'] = $this->varian->find($id);
        return view("page/product varian/edit_varian", $data);
    }

    public function store()
    {
        $nameVarian = $this->request->getPost('name_varian');
        $assetUrl = $this->request->getPost('asset_url');
        $varianImg = $this->request->getFile('picture_varian');
        $id_product = $this->request->getVar('id_product');

        if ($varianImg) {
            // Generate a random name for the file
            $newName = $varianImg->getRandomName();

            // Move the file to the desired directory
            $varianImg->move('./img/', $newName);

            // Prepare the data array
            $data = [
                'name_varian' => $nameVarian,
                'asset_url' => $assetUrl,
                'picture_varian' => $newName,
                'id_product' => $id_product,
            ];

            // Assuming $model is an instance of your model class
            $this->varian->insert($data);

            // Redirect or do other operations after successful upload and data insertion
            session()->setFlashdata('success', 'Product Varian ' . $nameVarian . ' berhasil ditambahkan.');
            return redirect()->to('/products_varian');
        } else {
            // You might want to add appropriate error handling or validation here
            return redirect()->back()->with('error', 'File upload failed.');
        }
    }

    public function update()
    {
        $varian_id = $this->request->getPost('varian_id');
        $assetUrl = $this->request->getPost('asset_url');
        $name_varian = $this->request->getPost('name_varian');
        $data = [
            'id' => $varian_id,
            'name_varian' => $name_varian,
            'asset_url' => $assetUrl,
            'id_product' => $this->request->getPost('id_product'),
        ];

        // Get uploaded images
        $uploadedFiles = $this->request->getFile('picture_varian');

        // If there are uploaded images
        if ($uploadedFiles->getName() != "") {
            // Remove old images
            $oldImagesString = $this->request->getPost('imgold');

            $imagePath = './img/' . trim($oldImagesString);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $newName = $uploadedFiles->getRandomName();
            $uploadedFiles->move('./img/', $newName);
            $data['picture_varian'] = $newName;
        }

        // Update data in the database using the model
        $this->varian->update($varian_id, $data);

        // Redirect or respond as needed
        session()->setFlashdata('success', 'Product Varian ' . $name_varian . ' berhasil diupdate.');
        return redirect()->to('/products_varian');
    }

    function delete($id)
    {
        $dataVarian = $this->varian->find($id);
        if (empty($dataVarian)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Denah Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = $dataVarian->picture_varian;

        $imagePath = './img/' . trim($img);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $this->varian->delete($id);
        session()->setFlashdata('success', 'Product Varian ' . $id . ' berhasil dihapus.');
        return redirect()->to('/products_varian');
    }

}
