<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table         = 'tbl_laporan';
    protected $primaryKey    = 'lap_id';
    protected $allowedFields = ['lap_name','lap_unit','lap_year','lap_link','lap_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'lap_created_at';
    protected $updatedField  = 'lap_updated_at';

    public function getLap_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_laporan.*,tbl_lapcategory.* FROM
			tbl_laporan LEFT JOIN tbl_lapcategory ON lap_category_id=lapcategory_id 
			WHERE lapcategory_slug='$slug'
            ORDER BY tbl_laporan.lap_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
}
