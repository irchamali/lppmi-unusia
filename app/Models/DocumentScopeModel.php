<?php
// app/Models/DocumentScopeModel.php
namespace App\Models;
use CodeIgniter\Model;

class DocumentScopeModel extends Model
{
    protected $table         = 'tbl_document_scope';
    protected $primaryKey    = 'scope_id';
    protected $allowedFields = ['scope_name', 'scope_slug', 'scope_description', 'scope_status'];
    public $timestamps = false; // Karena tabel ini tidak punya created_at/updated_at di dump
}