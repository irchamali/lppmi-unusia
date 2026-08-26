<?php

namespace App\Models;

use CodeIgniter\Model;

class LapCategoryModel extends Model
{
    protected $table            = 'tbl_lapcategory';
    protected $primaryKey       = 'lapcategory_id';
    protected $allowedFields    = ['lapcategory_name', 'lapcategory_slug'];

    public function getLap_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_laporan.*,tbl_lapcategory.* FROM
			tbl_laporan LEFT JOIN tbl_lapcategory ON lap_category_id=lapcategory_id 
			WHERE lapcategory_slug='$slug'
            ORDER BY tbl_laporan.lap_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
    
}
