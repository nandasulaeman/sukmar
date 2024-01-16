<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class VarianModel extends Model
{
    protected $table = 'varian';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name_varian', 'picture_varian', 'asset_url', 'id_product'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

    public function getVarianProduct()
    {
        $this->select('varian.*, product.name_product');
        $this->join('product', 'product.id = varian.id_product');
        return $this->get()->getResult();
    }
}
?>