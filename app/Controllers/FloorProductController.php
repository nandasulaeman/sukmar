<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\MarketModel;
use App\Models\ProductModel;

class FloorProductController extends BaseController
{
    protected $market;
    protected $product;
    protected $floorproduct;
    protected $floorplan;

    public function __construct()
    {
        $this->market = new MarketModel();
        $this->product = new ProductModel();
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
    }

    public function index()
    {
        $data['floorproduct'] = $this->floorproduct->getFloorProduct();
        return view("page/product floor/table_floor", $data);
    }

    public function create()
    {
        $data['floorproduct'] = $this->floorproduct->getFloorProduct();
        $data['product'] = $this->product->findAll();
        $data['floorplan'] = $this->floorplan->findAll();
        return view("page/product floor/create_floor", $data);
    }

    public function edit($id)
    {
        $data['floorproduct'] = $this->floorproduct->find($id);
        $data['product'] = $this->product->findAll();
        $data['floorplan'] = $this->floorplan->findAll();
        return view("page/product floor/edit_floor", $data);
    }

    public function store()
    {
        // Handle dynamic floor plans
        $floorPlans = $this->request->getPost('id_floor');
        $id_product = $this->request->getPost('id_product');
        $data = [
            'id_floor_plan' => $floorPlans,
            'id_product' => $id_product,
        ];
        $this->floorproduct->insert($data);

        session()->setFlashdata('success', 'Denah Produk berhasil ditambahkan.');
        return redirect()->to('/products_floor');
    }

    public function update()
    {
        $floorId = $this->request->getPost('floor_id');
        $floorPlans = $this->request->getPost('id_floor');
        $id_product = $this->request->getPost('id_product');
        $data = [
            'id' => $floorId,
            'id_floor_plan' => $floorPlans,
            'id_product' => $id_product,
        ];
        // Update data in the database using the model
        $this->floorproduct->update($floorId, $data);

        // Redirect or respond as needed
        session()->setFlashdata('success', 'Denah Produk ' . $floorId . ' berhasil diupdate.');
        return redirect()->to('/products_floor');
    }

    function delete($id)
    {
        $datafloor = $this->floorproduct->find($id);
        if (empty($datafloor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Denah Tidak ditemukan !');
        }
        $this->floorproduct->delete($id);
        session()->setFlashdata('success', 'Denah Produk ' . $id . ' berhasil dihapus.');
        return redirect()->to('/products_floor');
    }

}
