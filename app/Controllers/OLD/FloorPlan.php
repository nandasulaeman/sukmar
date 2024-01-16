<?php

namespace App\Controllers;

use App\Models\FloorPlanModel;
use App\Models\MarketModel;

class FloorPlan extends BaseController
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
        return view("page/management_floor_plan", $data);
    }

    public function store()
    {
        // Handle dynamic floor plans
        $floorPlans = $this->request->getPost('name_floor');
        $floorPlanImages = $this->request->getFile('picture_floor');
        $id_market = $this->request->getVar('id_market');

        if ($floorPlanImages->isValid() && !$floorPlanImages->hasMoved()) {
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

            // Process the data (e.g., save to the database)
            // Assuming $model is an instance of your model class
            $this->floorplan->insert($data);

            // Redirect or do other operations after successful upload and data insertion
            return redirect()->to('/market/floor');
        } else {
            // Handle the case where no file was uploaded or an error occurred
            // You might want to add appropriate error handling or validation here
            return redirect()->back()->with('error', 'File upload failed.');
        }

        // Save floor plan data to the database using the model
    }

    public function update()
    {
        $floorId = $this->request->getPost('floor_id');
        $data = [
            'id' => $floorId,
            'name_floor' => $this->request->getPost('name_floor'),
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

        // Redirect or respond as needed
        return redirect()->to('/market/floor');
    }

    function delete($id)
    {
        $datafloor = $this->floorplan->find($id);
        if (empty($datafloor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Denah Tidak ditemukan !');
        }
        // $imgs = json_decode();
        $img = $datafloor->picture_floor;

        $imagePath = './img/' . trim($img);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $this->floorplan->delete($id);
        return redirect()->to('/market/floor');
    }

}
