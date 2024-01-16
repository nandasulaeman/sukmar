<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\MarketModel;

class Market extends BaseController
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
        $data['market'] = $this->market->findAll();
        helper(['form', 'url']);
        return view("page/management_market", $data);
    }

    public function store()
    {
        $data = [
            'name_market' => $this->request->getPost('name_market'),
            'description_market' => $this->request->getPost('description_market'),
            'address' => $this->request->getPost('address'),
            'longitude' => $this->request->getPost('longitude'),
            'latitude' => $this->request->getPost('latitude'),
        ];

        // Handle multiple images
        $uploadedFiles = $this->request->getFileMultiple('picture_market');
        $imageNames = [];
        foreach ($uploadedFiles as $file) {
            $newName = $file->getRandomName();
            $file->move('./img/', $newName);
            $imageNames[] = $newName;
        }

        $data['picture_market'] = implode(',', $imageNames);

        // Save data to the database using the model
        $this->market->insert($data);
        $lastInsertedId = $this->market->insertID();

        // Handle dynamic floor plans
        $floorPlans = $this->request->getPost('name_floor');
        $floorPlanImages = $this->request->getFileMultiple('picture_floor');
        $floorPlanData = [];

        foreach ($floorPlanImages as $key => $file) {
            $newName = $file->getRandomName();
            $file->move('./img/', $newName);
            $floorPlanData[] = [
                'name_floor' => $floorPlans[$key],
                'picture_floor' => $newName,
                'id_market' => $lastInsertedId,
            ];
        }

        // Save floor plan data to the database using the model
        $this->floorplan->insertBatch($floorPlanData);
        session()->setFlashdata('message', 'Tambah Data Product Berhasil');
        return redirect()->to('/market');
    }

    public function update()
    {
        $marketId = $this->request->getPost('market_id');
        $data = [
            'id' => $marketId,
            'name_market' => $this->request->getPost('name_market'),
            'description_market' => $this->request->getPost('description_market'),
            'address' => $this->request->getPost('address'),
            'longitude' => $this->request->getPost('longitude'),
            'latitude' => $this->request->getPost('latitude'),
        ];

        // Get uploaded images
        $uploadedFiles = $this->request->getFileMultiple('picture_market');
        // dd($uploadedFiles[0]->getName());

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
            $data['picture_market'] = implode(',', $imageNames);
        }

        // Update data in the database using the model
        $this->market->update($marketId, $data);

        // Redirect or respond as needed
        return redirect()->to('/market');
    }

    function delete($id)
    {
        $datamarket = $this->market->find($id);
        if (empty($datamarket)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Market Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = explode(',', $datamarket->picture_market);

        foreach ($img as $file) {
            $imagePath = './img/' . trim($file);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $this->floorplan->where('id_market', $id)->delete();

        $this->market->delete($id);
        session()->setFlashdata('message', 'Delete Data Market Berhasil');
        return redirect()->to('/market');
    }
}
