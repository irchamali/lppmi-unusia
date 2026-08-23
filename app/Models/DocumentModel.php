<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table         = 'tbl_document';
    protected $primaryKey    = 'docs_id';
    protected $allowedFields = ['docs_name','docs_unit','docs_sk','docs_year','docs_link','docs_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'docs_created_at';
    protected $updatedField  = 'docs_updated_at';

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
