<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class ProductMarket extends Model
{
    protected $table = 'product_market';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_product', 'id_market'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

}
?>