<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\MarketModel;
use App\Models\ProductMarket;

class MarketController extends BaseController
{
    protected $market;
    protected $floorplan;
    protected $product_market;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->market = new MarketModel();
        $this->floorplan = new FloorPlanModel();
        $this->product_market = new ProductMarket();
    }

    public function index()
    {
        $data['market'] = $this->market->findAll();
        return view("page/market/table_market", $data);
    }

    public function create()
    {
        $data['market'] = $this->market->findAll();
        return view("page/market/create_market", $data);
    }

    public function edit($id)
    {
        $data['market'] = $this->market->find($id);
        $data['floor_plan'] = $this->floorplan->where('id_market', $id)->find();
        return view("page/market/edit_market", $data);
    }

    public function store()
    {

        $name_market = $this->request->getPost('name_market');
        $data = [
            'name_market' => $name_market,
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
        session()->setFlashdata('success', 'Pasar ' . $name_market . ' berhasil ditambahkan.');
        return redirect()->to('/markets');
    }

    public function update()
    {
        $marketId = $this->request->getPost('market_id');
        $name_market = $this->request->getPost('name_market');
        $data = [
            'id' => $marketId,
            'name_market' => $name_market,
            'description_market' => $this->request->getPost('description_market'),
            'address' => $this->request->getPost('address'),
            'longitude' => $this->request->getPost('longitude'),
            'latitude' => $this->request->getPost('latitude'),
        ];

        // Get uploaded images
        $uploadedFiles = $this->request->getFileMultiple('picture_market');

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
        session()->setFlashdata('success', 'Pasar ' . $name_market . ' berhasil diupdate.');
        return redirect()->to('/markets');
    }

    function delete($id)
    {
        $datamarket = $this->market->find($id);
        if (empty($datamarket)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Market Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = explode(',', $datamarket->picture_market);
        $datafloor = $this->floorplan->where('id_market', $id)->find();

        foreach ($img as $file) {
            $imagePath = './img/' . trim($file);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($datafloor) {
            $imgPath = './img/' . trim($datafloor[0]->picture_floor);
            unlink($imgPath);
            $this->floorplan->where('id_market', $id)->delete();
        }

        $this->product_market->where('id_market', $id)->delete();
        $this->market->delete($id);
        session()->setFlashdata('success', 'Pasar ' . $id . ' berhasil dihapus.');
        return redirect()->to('/markets');
    }
}
