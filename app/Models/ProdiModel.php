<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'tbl_prodi';
    protected $primaryKey       = 'prodi_id';
    protected $allowedFields    = ['prodi_nama', 'prodi_slug','prodi_kode','prodi_strata','prodi_link'];

    public function get_post_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_akreditasi.*,tbl_prodi.* FROM
			tbl_akreditasi LEFT JOIN tbl_prodi ON prodi_id=prodi_id 
			WHERE prodi_slug='$slug'
            ORDER BY tbl_akreditasi.created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
    
}
