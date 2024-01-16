<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class ProductAccessLogModel extends Model
{
    protected $table = 'product_access_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['access_count', 'id_product', 'updated_at', 'created_at'];
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];
    protected $useTimestamps = true;

}
?>