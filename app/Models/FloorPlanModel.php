<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class FloorPlanModel extends Model
{
    protected $table = 'floor_plan';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name_floor', 'id_market', 'picture_floor'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

    public function getFloor()
    {
        $this->select('floor_plan.*, market.name_market');
        $this->join('market', 'floor_plan.id_market = market.id');
        return $this->get()->getResult();
    }
}
?>