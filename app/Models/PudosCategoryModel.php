<?php

namespace App\Models;

use CodeIgniter\Model;

class PudosCategoryModel extends Model
{
    protected $table            = 'tbl_pudoscategory';
    protected $primaryKey       = 'pudoscategory_id';
    protected $allowedFields    = ['pudoscategory_name', 'pudoscategory_slug'];

    public function getDocs_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_pudos.*,tbl_pudoscategory.* FROM
			tbl_pudos LEFT JOIN tbl_pudoscategory ON pudos_category_id=pudoscategory_id 
			WHERE pudoscategory_slug='$slug'
            ORDER BY tbl_pudos.pudos_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
    
}
