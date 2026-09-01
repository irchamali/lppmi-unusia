<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentCategoryModel extends Model
{
    protected $table         = 'tbl_document_category';
    protected $primaryKey    = 'category_id';
    protected $allowedFields = ['category_name', 'category_slug', 'category_description', 'category_status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
