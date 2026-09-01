<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDocumentScopeModel extends Model
{
    protected $table = 'tbl_user_document_scope';
    protected $primaryKey = 'user_document_scope_id';
    protected $allowedFields = ['user_id', 'scope_id', 'fak_id', 'prodi_id', 'scope_status'];

    public function getByUser(int $userId): array
    {
        return $this->db->table($this->table)
            ->select('tbl_user_document_scope.*, tbl_document_scope.scope_name, tbl_document_scope.scope_slug, tbl_fakultas.fak_name, tbl_prodi.prodi_nama')
            ->join('tbl_document_scope', 'tbl_document_scope.scope_id = tbl_user_document_scope.scope_id')
            ->join('tbl_fakultas', 'tbl_fakultas.fak_id = tbl_user_document_scope.fak_id', 'left')
            ->join('tbl_prodi', 'tbl_prodi.prodi_id = tbl_user_document_scope.prodi_id', 'left')
            ->where('tbl_user_document_scope.user_id', $userId)
            ->where('tbl_user_document_scope.scope_status', 1)
            ->get()
            ->getResultArray();
    }
}