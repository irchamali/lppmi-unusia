<?php

namespace App\Models;

use CodeIgniter\Model;

class DocsCategoryModel extends Model
{
    protected $table            = 'tbl_docscategory';
    protected $primaryKey       = 'docscategory_id';
    protected $allowedFields    = ['docscategory_name', 'docscategory_slug'];

    public function getDocs_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_document.*,tbl_docscategory.* FROM
			tbl_document LEFT JOIN tbl_docscategory ON docs_category_id=docscategory_id 
			WHERE docscategory_slug='$slug'
            ORDER BY tbl_document.docs_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }
    
}
