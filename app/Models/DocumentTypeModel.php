<?php
// app/Models/DocumentTypeModel.php
namespace App\Models;
use CodeIgniter\Model;

class DocumentTypeModel extends Model
{
    protected $table         = 'tbl_document_type';
    protected $primaryKey    = 'type_id';
    protected $allowedFields = ['type_name', 'type_slug', 'type_description', 'type_status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}