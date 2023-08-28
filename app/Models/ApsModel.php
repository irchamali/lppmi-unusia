<?php

namespace App\Models;

use CodeIgniter\Model;

class ApsModel extends Model
{
    protected $table         = 'tbl_akreditasi';
    protected $primaryKey    = 'aps_id';
    protected $allowedFields = ['prodi','no_sk','thn_sk','peringkat','tgl_kadaluarsa','aps_link'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAps_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_akreditasi.*,tbl_prodi.* FROM
			tbl_akreditasi LEFT JOIN tbl_prodi ON prodi=prodi_id 
			WHERE prodi_slug='$slug'
            ORDER BY tbl_akreditasi.created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
}
