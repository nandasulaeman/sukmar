<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class ProductLogModel extends Model
{
    protected $table = 'product_access_logs';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['access_count', 'id_product'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
?>