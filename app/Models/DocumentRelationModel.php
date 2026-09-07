<?php
// app/Models/DocumentRelationModel.php
namespace App\Models;

use CodeIgniter\Model;

class DocumentRelationModel extends Model
{
    protected $table         = 'tbl_document_relations';
    protected $primaryKey    = 'relation_id';
    protected $allowedFields = [
        'document_id', 'related_document_id', 'relation_type_id', 'relation_notes', 'created_by',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /**
     * Ambil dokumen terkait (publik/approved) untuk sebuah dokumen, dikelompokkan per jenis relasi.
     * Relasi bersifat dua arah: dokumen bisa tampil sebagai document_id maupun related_document_id.
     */
    public function getPublicRelatedDocuments(int $documentId): array
    {
        $rows = $this->db->table($this->table)
            ->select('tbl_document_relations.relation_id, tbl_document_relations.relation_notes, tbl_document_relation_type.relation_name, tbl_document_relation_type.relation_slug,
                CASE WHEN tbl_document_relations.document_id = ' . (int) $documentId . ' THEN tbl_document_relations.related_document_id ELSE tbl_document_relations.document_id END AS other_document_id', false)
            ->join('tbl_document_relation_type', 'tbl_document_relation_type.relation_type_id = tbl_document_relations.relation_type_id', 'left')
            ->groupStart()
                ->where('tbl_document_relations.document_id', $documentId)
                ->orWhere('tbl_document_relations.related_document_id', $documentId)
            ->groupEnd()
            ->get()
            ->getResultArray();

        if ($rows === []) {
            return [];
        }

        $otherIds = array_values(array_unique(array_map(static fn ($row) => (int) $row['other_document_id'], $rows)));

        $documents = $this->db->table('tbl_documents')
            ->select('tbl_documents.document_id, tbl_documents.document_title, tbl_documents.document_number, tbl_documents.document_date, tbl_document_category.category_name, tbl_document_type.type_name')
            ->join('tbl_document_category', 'tbl_document_category.category_id = tbl_documents.category_id', 'left')
            ->join('tbl_document_type', 'tbl_document_type.type_id = tbl_documents.type_id', 'left')
            ->whereIn('tbl_documents.document_id', $otherIds)
            ->where('tbl_documents.status', 'approved')
            ->get()
            ->getResultArray();

        $documentsById = [];
        foreach ($documents as $document) {
            $documentsById[(int) $document['document_id']] = $document;
        }

        $grouped = [];
        foreach ($rows as $row) {
            $otherId = (int) $row['other_document_id'];

            if (!isset($documentsById[$otherId])) {
                continue; // dokumen terkait belum/tidak dipublikasikan
            }

            $relationName = $row['relation_name'] ?: 'Terkait';
            $grouped[$relationName][] = $documentsById[$otherId] + [
                'relation_notes' => $row['relation_notes'],
            ];
        }

        return $grouped;
    }
}
