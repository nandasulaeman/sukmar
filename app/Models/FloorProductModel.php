<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class FloorProductModel extends Model
{
    protected $table = 'floor_product';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_floor_plan', 'id_product'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

    public function getFloorProduct()
    {
        $query = $this->db->query('SELECT floor_product.*, product.name_product, floor_plan.name_floor, floor_plan.picture_floor FROM floor_product INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan INNER JOIN product ON product.id = floor_product.id_product;');
        return $query->getResult();
    }

    public function getFloorProductID($id)
    {
        $query = $this->db->query('SELECT floor_product.*, product.name_product, product.id as idpro, floor_plan.name_floor, floor_plan.picture_floor FROM floor_product INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan INNER JOIN product ON product.id = floor_product.id_product where floor_product.id ="' . $id . '";');
        return $query->getResult();
    }
}
?>