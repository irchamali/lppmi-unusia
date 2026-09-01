<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table         = 'tbl_documents';
    protected $primaryKey    = 'document_id';
    protected $allowedFields = [
        'document_title', 'document_number', 'category_id', 'type_id',
        'scope_id', 'ppepp_stage', 'fak_id', 'prodi_id', 'document_description',
        'document_file', 'document_date', 'status', 'user_id',
        'validated_by', 'validated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // Update query relasi untuk datatable
    public function getAllDocuments()
    {
        return $this->db->table($this->table)
            ->select('tbl_documents.*, tbl_document_category.category_name, tbl_document_type.type_name, tbl_document_scope.scope_name')
            ->join('tbl_document_category', 'tbl_documents.category_id = tbl_document_category.category_id', 'left')
            ->join('tbl_document_type', 'tbl_documents.type_id = tbl_document_type.type_id', 'left')
            ->join('tbl_document_scope', 'tbl_documents.scope_id = tbl_document_scope.scope_id', 'left')
            ->orderBy('tbl_documents.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
