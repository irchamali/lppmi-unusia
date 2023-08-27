<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'tbl_prodi';
    protected $primaryKey       = 'prodi_id';
    protected $allowedFields    = ['prodi_nama', 'prodi_slug','prodi_kode','prodi_strata'];

    public function get_post_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_document.*,tbl_docscategory.* FROM
			tbl_document LEFT JOIN tbl_docscategory ON docs_category_id=docscategory_id 
			WHERE docscategory_slug='$slug'
            ORDER BY tbl_document.docs_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
    
}
