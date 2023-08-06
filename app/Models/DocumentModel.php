<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table         = 'tbl_document';
    protected $primaryKey    = 'docs_id';
    protected $allowedFields = ['docs_name','docs_unit','docs_link','docs_category'];
    protected $useTimestamps = true;
    protected $createdField  = 'slider_created_at';
    protected $updatedField  = 'slider_updated_at';
}
