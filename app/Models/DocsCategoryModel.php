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
        return $this->db->table('tbl_document')
            ->select('tbl_document.*, tbl_docscategory.*')
            ->join('tbl_docscategory', 'tbl_document.docs_category_id = tbl_docscategory.docscategory_id', 'left')
            ->where('tbl_docscategory.docscategory_slug', $slug)
            ->orderBy('tbl_document.docs_created_at', 'DESC')
            ->get();
    }
    
}
