<?php
namespace App\Models;

use CodeIgniter\Model;
use ResponseHelper;
use CommonHelper;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name_product', 'description_product', 'picture_product', 'category', 'status'];
    protected $useAutoIncrement = true;
    protected $dontAllowFields = [];

    public function getProductVarianID($id)
    {
        return $this->select('product.*, varian.name_varian, varian.asset_url, varian.picture_varian')
            ->join('varian', 'varian.id_product = product.id', 'left')
            ->where('product.id', $id)
            ->first();
    }

    public function getProductVarian()
    {
        return $this->select('product.*, varian.name_varian, varian.asset_url, varian.picture_varian')
            ->join('varian', 'varian.id_product = product.id', 'left')
            ->first();
    }

    public function getProductMarket()
    {
        return $this->select('product.id, market.name_market')
            ->join('product_market', 'product_market.id_product = product.id', 'left')
            ->join('market', 'market.id = product_market.id_market', 'left')
            ->get();
    }

    function getProductMarkets()
    {
        $query = $this->db->query('SELECT product.*, market.name_market from product INNER JOIN product_market ON product_market.id_product = product.id INNER JOIN market ON market.id = product_market.id_market;');
        return $query->getResult();
    }

    function getProductMarketId($id)
    {
        $query = $this->db->query('SELECT product.*, market.name_market  from product INNER JOIN product_market ON product_market.id_product = product.id INNER JOIN market ON market.id = product_market.id_market where product.id ="' . $id . '";');
        return $query->getRow();
    }

    function getProductAll()
    {
        $query = $this->db->query('
            SELECT 
                product.*, 
                GROUP_CONCAT(DISTINCT floor_plan.name_floor ORDER BY floor_plan.id ASC) AS name_floor,
                GROUP_CONCAT(DISTINCT floor_plan.picture_floor ORDER BY floor_plan.id ASC) AS picture_floor,
                GROUP_CONCAT(DISTINCT varian.name_varian ORDER BY varian.id ASC) AS name_varian,
                GROUP_CONCAT(DISTINCT varian.asset_url ORDER BY varian.id ASC) AS asset_url,
                GROUP_CONCAT(DISTINCT varian.picture_varian ORDER BY varian.id ASC) AS picture_varian
            FROM product
            INNER JOIN floor_product ON floor_product.id_product = product.id
            INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan
            INNER JOIN varian ON varian.id_product = product.id
            GROUP BY product.id;
        ');

        return $query->getResult();
    }

    function getProductbyID($id)
    {
        $query = $this->db->query('
        SELECT 
            product.*, 
            GROUP_CONCAT(DISTINCT floor_plan.name_floor ORDER BY floor_plan.id ASC) AS name_floor,
            GROUP_CONCAT(DISTINCT floor_plan.picture_floor ORDER BY floor_plan.id ASC) AS picture_floor,
            GROUP_CONCAT(DISTINCT varian.name_varian ORDER BY varian.id ASC) AS name_varian,
            GROUP_CONCAT(DISTINCT varian.asset_url ORDER BY varian.id ASC) AS asset_url,
            GROUP_CONCAT(DISTINCT varian.picture_varian ORDER BY varian.id ASC) AS picture_varian
        FROM product
        INNER JOIN floor_product ON floor_product.id_product = product.id
        INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan
        INNER JOIN varian ON varian.id_product = product.id
        WHERE product.id = ?
        GROUP BY product.id;',
            [$id]
        );
        return $query->getRow();
    }


    function getProductbyCat($id)
    {
        $query = $this->db->query('
        SELECT 
            product.*, 
            GROUP_CONCAT(DISTINCT floor_plan.name_floor ORDER BY floor_plan.id ASC) AS name_floor,
            GROUP_CONCAT(DISTINCT floor_plan.picture_floor ORDER BY floor_plan.id ASC) AS picture_floor,
            GROUP_CONCAT(DISTINCT varian.name_varian ORDER BY varian.id ASC) AS name_varian,
            GROUP_CONCAT(DISTINCT varian.asset_url ORDER BY varian.id ASC) AS asset_url,
            GROUP_CONCAT(DISTINCT varian.picture_varian ORDER BY varian.id ASC) AS picture_varian
        FROM product
        INNER JOIN floor_product ON floor_product.id_product = product.id
        INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan
        INNER JOIN varian ON varian.id_product = product.id
        WHERE product.category LIKE ?
        GROUP BY product.id;',
            ['%' . $id . '%']
        );
        return $query->getResult();
    }

    function getProductbyFloor($id)
    {
        $query = $this->db->query('
        SELECT 
            product.*, 
            GROUP_CONCAT(DISTINCT floor_plan.name_floor ORDER BY floor_plan.id ASC) AS name_floor,
            GROUP_CONCAT(DISTINCT floor_plan.picture_floor ORDER BY floor_plan.id ASC) AS picture_floor,
            GROUP_CONCAT(DISTINCT varian.name_varian ORDER BY varian.id ASC) AS name_varian,
            GROUP_CONCAT(DISTINCT varian.asset_url ORDER BY varian.id ASC) AS asset_url,
            GROUP_CONCAT(DISTINCT varian.picture_varian ORDER BY varian.id ASC) AS picture_varian
        FROM product
        INNER JOIN floor_product ON floor_product.id_product = product.id
        INNER JOIN floor_plan ON floor_plan.id = floor_product.id_floor_plan
        INNER JOIN varian ON varian.id_product = product.id
        WHERE floor_plan.name_floor LIKE ?
        GROUP BY product.id;',
            ['%' . $id . '%']
        );
        return $query->getResult();
    }

}
