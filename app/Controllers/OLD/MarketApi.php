<?php

namespace App\Controllers;

use App\Models\MarketModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FloorPlanModel;
use App\Models\FloorProductModel;
use App\Models\ProductModel;
use App\Models\VarianModel;

class MarketApi extends ResourceController
{
    use ResponseTrait;
    protected $floorplan;
    protected $product;
    protected $floorproduct;
    protected $varian;
    protected $market;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->form_validation = \Config\Services::validation();
        $this->floorproduct = new FloorProductModel();
        $this->floorplan = new FloorPlanModel();
        $this->product = new ProductModel();
        $this->varian = new VarianModel();
        $this->market = new MarketModel();
    }

    public function index()
    {
        $data = $this->market->findAll();
        $datafull = [
            'Result' => $data,
        ];
        return $this->respond($datafull);
    }

    public function show($id = null)
    {
        $data = $this->market->find($id);

        if ($data) {
            $exploded = explode(',', $data->picture_market);
            $pic = array();
            $j = 1;

            foreach ($exploded as $elem) {
                $pic[] = $elem;
                $j++;
            }

            $response[] = array(
                'id' => $data->id,
                'name_market' => $data->name_market,
                'description_market' => $data->description_market,
                'picture_market' => $pic,
                'address' => $data->address,
                'longitude' => $data->longitude,
                'latitude' => $data->latitude
            );
        }

        $datafull = [
            'message' => 'Get All Data ' . $id,
            'Result' => $response,
        ];
        return $this->respond($datafull);
    }

    public function marketFloor($id = null)
    {
        $data = $this->floorplan
            ->where('id_market', $id)
            ->findAll();

        $datafull = [
            'Result' => $data,
        ];

        return $this->respond($datafull);
    }
}
