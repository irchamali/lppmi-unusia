<?php
// app/Models/DocumentRelationTypeModel.php
namespace App\Models;
use CodeIgniter\Model;

class DocumentRelationTypeModel extends Model
{
    protected $table         = 'tbl_document_relation_type';
    protected $primaryKey    = 'relation_type_id';
    protected $allowedFields = ['relation_name', 'relation_slug', 'relation_description', 'relation_status'];
    public $timestamps = false; // Karena tabel ini tidak punya created_at/updated_at di dump
}
