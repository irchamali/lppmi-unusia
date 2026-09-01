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
        'validated_by', 'validated_at', 'validation_notes'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // Update query relasi untuk datatable
    public function getAllDocuments()
    {
        return $this->documentQuery()
            ->orderBy('tbl_documents.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function getDocumentsByUser(int $userId)
    {
        return $this->documentQuery()
            ->where('tbl_documents.user_id', $userId)
            ->orderBy('tbl_documents.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function getSubmittedDocuments()
    {
        return $this->documentQuery()
            ->where('tbl_documents.status', 'submitted')
            ->orderBy('tbl_documents.created_at', 'ASC')
            ->get()
            ->getResultArray();
    }
    public function getDocumentsForValidator(int $userId): array
    {
        return $this->documentQuery()
            ->join('tbl_user_document_scope', 'tbl_user_document_scope.scope_id = tbl_documents.scope_id AND (tbl_user_document_scope.fak_id <=> tbl_documents.fak_id) AND (tbl_user_document_scope.prodi_id <=> tbl_documents.prodi_id)')
            ->where('tbl_user_document_scope.user_id', $userId)
            ->where('tbl_user_document_scope.scope_status', 1)
            ->groupBy('tbl_documents.document_id')
            ->orderBy('tbl_documents.updated_at', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function userHasDocumentScope(int $userId, int $scopeId, ?int $fakultasId, ?int $prodiId): bool
    {
        return $this->db->table('tbl_user_document_scope')
            ->where('user_id', $userId)
            ->where('scope_id', $scopeId)
            ->where('fak_id', $fakultasId)
            ->where('prodi_id', $prodiId)
            ->where('scope_status', 1)
            ->countAllResults() > 0;
    }
    public function summarizeDocuments(array $documents): array
    {
        $summary = [
            'total' => count($documents),
            'statuses' => ['submitted' => 0, 'approved' => 0, 'revised' => 0, 'rejected' => 0, 'archived' => 0],
            'categories' => [],
            'scopes' => [],
        ];

        foreach ($documents as $document) {
            $status = $document['status'] ?: 'submitted';
            $summary['statuses'][$status] = ($summary['statuses'][$status] ?? 0) + 1;
            $category = $document['category_name'] ?: 'Uncategorized';
            $scope = $document['scope_name'] ?: 'Unspecified';
            $summary['categories'][$category] = ($summary['categories'][$category] ?? 0) + 1;
            $summary['scopes'][$scope] = ($summary['scopes'][$scope] ?? 0) + 1;
        }

        arsort($summary['categories']);
        arsort($summary['scopes']);

        return $summary;
    }
    protected function documentQuery()
    {
        return $this->db->table($this->table)
            ->select('tbl_documents.*, tbl_document_category.category_name, tbl_document_type.type_name, tbl_document_scope.scope_name, tbl_document_scope.scope_slug, tbl_fakultas.fak_name, tbl_prodi.prodi_nama')
            ->join('tbl_document_category', 'tbl_documents.category_id = tbl_document_category.category_id', 'left')
            ->join('tbl_document_type', 'tbl_documents.type_id = tbl_document_type.type_id', 'left')
            ->join('tbl_document_scope', 'tbl_documents.scope_id = tbl_document_scope.scope_id', 'left')
            ->join('tbl_fakultas', 'tbl_documents.fak_id = tbl_fakultas.fak_id', 'left')
            ->join('tbl_prodi', 'tbl_documents.prodi_id = tbl_prodi.prodi_id', 'left');
    }
}
