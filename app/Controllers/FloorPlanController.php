<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\MarketModel;

class FloorPlanController extends BaseController
{
    protected $market;
    protected $floorplan;

    public function __construct()
    {
        $this->market = new MarketModel();
        $this->floorplan = new FloorPlanModel();
    }

    public function index()
    {
        $data['floor_plan'] = $this->floorplan->getFloor();
        $data['market'] = $this->market->findAll();
        helper(['form', 'url']);
        return view("page/market floor/table_floor", $data);
    }

    public function create()
    {
        $data['market'] = $this->market->findAll();
        $data['floor_plan'] = $this->floorplan->getFloor();
        return view("page/market floor/create_floor", $data);
    }

    public function edit($id)
    {
        $data['market'] = $this->market->findAll();
        $data['floor_plan'] = $this->floorplan->find($id);
        return view("page/market floor/edit_floor", $data);
    }

    public function store()
    {
        $floorPlans = $this->request->getPost('name_floor');
        $floorPlanImages = $this->request->getFile('picture_floor');
        $id_market = $this->request->getVar('id_market');

        if ($floorPlanImages) {
            // Generate a random name for the file
            $newName = $floorPlanImages->getRandomName();

            // Move the file to the desired directory
            $floorPlanImages->move('./img/', $newName);

            // Prepare the data array
            $data = [
                'name_floor' => $floorPlans,
                'picture_floor' => $newName,
                'id_market' => $id_market,
            ];

            $this->floorplan->insert($data);
            session()->setFlashdata('success', 'Denah berhasil ditambahkan.');
            return redirect()->to('/markets_floor');
        } else {
            session()->setFlashdata('error', 'Denah gagal ditambahkan.');
            return redirect()->back();
        }
    }

    public function update()
    {
        $floorId = $this->request->getPost('floor_id');
        $name_floor = $this->request->getPost('name_floor');
        $data = [
            'id' => $floorId,
            'name_floor' => $name_floor,
            'id_market' => $this->request->getPost('id_market'),
        ];

        // Get uploaded images
        $uploadedFiles = $this->request->getFile('picture_floor');

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
            $data['picture_floor'] = $newName;
        }

        // Update data in the database using the model
        $this->floorplan->update($floorId, $data);

        session()->setFlashdata('success', 'Denah ' . $name_floor . ' berhasil diupdate.');
        // Redirect or respond as needed
        return redirect()->to('/markets_floor');
    }

    function delete($id)
    {
        $datafloor = $this->floorplan->find($id);
        if (empty($datafloor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Denah Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = $datafloor->picture_floor;

        if ($img) {
            $imagePath = './img/' . trim($img);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->floorplan->delete($id);
        session()->setFlashdata('success', 'Denah ' . $id . ' berhasil dihapus.');
        return redirect()->to('/markets_floor');
    }

}
