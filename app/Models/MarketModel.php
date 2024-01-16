<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class MarketModel extends Model
{
    protected $table = 'market';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name_market', 'description_market', 'longitude', 'latitude', 'picture_market', 'address'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

    public function getMarketWithFloorPlans()
    {
        $this->select('product.*, market.name_market');
        $this->join('market', 'floor_plan.id_market = market.id');
        return $this->get()->getResult();
    }
}
?>