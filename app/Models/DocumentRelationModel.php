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
        'status', 'validated_by', 'validated_at', 'validation_notes',
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
            ->select('
                tbl_document_relations.relation_id,
                tbl_document_relations.document_id,
                tbl_document_relations.related_document_id,
                tbl_document_relations.relation_notes,
                tbl_document_relation_type.relation_name,
                tbl_document_relation_type.relation_slug
            ')
            ->join(
                'tbl_document_relation_type',
                'tbl_document_relation_type.relation_type_id = tbl_document_relations.relation_type_id',
                'left'
            )
            ->where('tbl_document_relations.status', 'approved')
            ->groupStart()
                ->where('tbl_document_relations.document_id', $documentId)
                ->orWhere('tbl_document_relations.related_document_id', $documentId)
            ->groupEnd()
            ->get()
            ->getResultArray();

        if ($rows === []) {
            return [];
        }

        /*
         * Tentukan ID dokumen lawan dari masing-masing relasi.
         */
        $otherIds = [];

        foreach ($rows as $row) {
            if ((int) $row['document_id'] === $documentId) {
                $otherIds[] = (int) $row['related_document_id'];
            } else {
                $otherIds[] = (int) $row['document_id'];
            }
        }

        $otherIds = array_values(array_unique($otherIds));

        $documents = $this->db->table('tbl_documents')
            ->select('
                tbl_documents.document_id,
                tbl_documents.document_title,
                tbl_documents.document_number,
                tbl_documents.document_date,
                tbl_document_category.category_name,
                tbl_document_type.type_name
            ')
            ->join(
                'tbl_document_category',
                'tbl_document_category.category_id = tbl_documents.category_id',
                'left'
            )
            ->join(
                'tbl_document_type',
                'tbl_document_type.type_id = tbl_documents.type_id',
                'left'
            )
            ->whereIn('tbl_documents.document_id', $otherIds)
            ->where('tbl_documents.status', 'approved')
            ->get()
            ->getResultArray();

        $documentsById = [];

        foreach ($documents as $document) {
            $documentsById[(int) $document['document_id']] = $document;
        }

        /*
         * Label kebalikan relasi jika dokumen yang sedang dibuka
         * berada pada sisi related_document_id.
         */
        $reverseRelationLabels = [
            'menggantikan'    => 'Digantikan',
            'mencabut'        => 'Dicabut oleh',
            'menjabarkan'     => 'Dijabarkan oleh',
            'menindaklanjuti' => 'Ditindaklanjuti oleh',
            'mengacu-pada'    => 'Diacu oleh',
            'mendukung'       => 'Didukung oleh',
            'terkait'         => 'Terkait',
        ];

        $grouped = [];

        foreach ($rows as $row) {

            $sourceDocumentId = (int) $row['document_id'];
            $targetDocumentId = (int) $row['related_document_id'];

            /*
             * Jika dokumen yang sedang dibuka adalah document_id,
             * berarti dia adalah sumber relasi.
             */
            $isSource = ($sourceDocumentId === $documentId);

            /*
             * Tentukan dokumen lawan.
             */
            if ($isSource) {
                $otherId = $targetDocumentId;
            } else {
                $otherId = $sourceDocumentId;
            }

            if (!isset($documentsById[$otherId])) {
                continue; // dokumen terkait belum/tidak dipublikasikan
            }

            /*
             * Tentukan nama relasi berdasarkan perspektif.
             *
             * Contoh:
             * document_id = 3
             * related_document_id = 2
             * relation = Menggantikan
             *
             * Buka dokumen 3:
             * -> MENGGANTIKAN
             *
             * Buka dokumen 2:
             * -> DIGANTIKAN
             */
            if ($isSource) {
                $relationName = $row['relation_name'] ?: 'Terkait';
            } else {
                $relationSlug = $row['relation_slug'] ?? '';

                $relationName = $reverseRelationLabels[$relationSlug]
                    ?? 'Terkait dengan';
            }

            $grouped[$relationName][] = $documentsById[$otherId] + [
                'relation_notes' => $row['relation_notes'],
            ];
        }

        return $grouped;
    }

    /**
     * Relasi dimana salah satu sisi dokumennya termasuk dalam daftar dokumen yang boleh dikelola manager.
     */
    public function getManagedRelations(array $allowedDocumentIds): array
    {
        $allowedDocumentIds = array_values(array_unique(array_map('intval', $allowedDocumentIds)));

        if ($allowedDocumentIds === []) {
            return [];
        }

        return $this->db->table($this->table)
            ->select('tbl_document_relations.*, tbl_document_relation_type.relation_name,
                d1.document_title AS document_title, d1.document_number AS document_number,
                d2.document_title AS related_document_title, d2.document_number AS related_document_number')
            ->join('tbl_document_relation_type', 'tbl_document_relation_type.relation_type_id = tbl_document_relations.relation_type_id', 'left')
            ->join('tbl_documents d1', 'd1.document_id = tbl_document_relations.document_id', 'left')
            ->join('tbl_documents d2', 'd2.document_id = tbl_document_relations.related_document_id', 'left')
            ->groupStart()
                ->whereIn('tbl_document_relations.document_id', $allowedDocumentIds)
                ->orWhereIn('tbl_document_relations.related_document_id', $allowedDocumentIds)
            ->groupEnd()
            ->orderBy('tbl_document_relations.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ringkasan relasi (nama & status dokumen lawan) untuk sekumpulan dokumen, dipakai di modal detail
     * agar manager & validator sama-sama melihat relasi terbaru yang dibuat.
     */
    public function getRelationsForDocuments(array $documentIds): array
    {
        $documentIds = array_values(array_unique(array_map('intval', $documentIds)));

        if ($documentIds === []) {
            return [];
        }

        $rows = $this->db->table($this->table)
            ->select('
                tbl_document_relations.document_id,
                tbl_document_relations.related_document_id,
                tbl_document_relations.relation_notes,
                tbl_document_relation_type.relation_name,
                tbl_document_relation_type.relation_slug
            ')
            ->join(
                'tbl_document_relation_type',
                'tbl_document_relation_type.relation_type_id = tbl_document_relations.relation_type_id',
                'left'
            )
            ->where('tbl_document_relations.status', 'approved')
            ->groupStart()
                ->whereIn('tbl_document_relations.document_id', $documentIds)
                ->orWhereIn('tbl_document_relations.related_document_id', $documentIds)
            ->groupEnd()
            ->get()
            ->getResultArray();

        if ($rows === []) {
            return [];
        }

        $otherIds = [];

        foreach ($rows as $row) {
            $otherIds[] = (int) $row['document_id'];
            $otherIds[] = (int) $row['related_document_id'];
        }

        $documents = $this->db->table('tbl_documents')
            ->select('document_id, document_title, document_number, status')
            ->whereIn('document_id', array_values(array_unique($otherIds)))
            ->get()
            ->getResultArray();

        $documentsById = [];

        foreach ($documents as $document) {
            $documentsById[(int) $document['document_id']] = $document;
        }

        /*
         * Label kebalikan relasi.
         */
        $reverseRelationLabels = [
            'menggantikan'    => 'Digantikan',
            'mencabut'        => 'Dicabut oleh',
            'menjabarkan'     => 'Dijabarkan oleh',
            'menindaklanjuti' => 'Ditindaklanjuti oleh',
            'mengacu-pada'    => 'Diacu oleh',
            'mendukung'       => 'Didukung oleh',
            'terkait'         => 'Terkait',
        ];

        $grouped = [];

        foreach ($rows as $row) {

            $sourceDocumentId = (int) $row['document_id'];
            $targetDocumentId = (int) $row['related_document_id'];

            /*
             * --------------------------------------------------
             * Sisi sumber
             * --------------------------------------------------
             */
            if (
                in_array($sourceDocumentId, $documentIds, true)
                && isset($documentsById[$targetDocumentId])
            ) {

                $relationName = $row['relation_name'] ?: 'Terkait';

                $entry = [
                    'relation_name'  => $relationName,
                    'relation_notes' => $row['relation_notes'],
                ];

                $grouped[$sourceDocumentId][] =
                    $documentsById[$targetDocumentId] + $entry;
            }

            /*
             * --------------------------------------------------
             * Sisi target
             * --------------------------------------------------
             */
            if (
                in_array($targetDocumentId, $documentIds, true)
                && isset($documentsById[$sourceDocumentId])
            ) {

                $relationSlug = $row['relation_slug'] ?? '';

                $relationName = $reverseRelationLabels[$relationSlug]
                    ?? 'Terkait dengan';

                $entry = [
                    'relation_name'  => $relationName,
                    'relation_notes' => $row['relation_notes'],
                ];

                $grouped[$targetDocumentId][] =
                    $documentsById[$sourceDocumentId] + $entry;
            }
        }

        return $grouped;
    }

    /**
     * Cek apakah pasangan dokumen (dua arah) dengan jenis relasi tertentu sudah ada, mencegah duplikasi.
     */
    public function relationExists(int $documentId, int $relatedDocumentId, int $relationTypeId, ?int $excludeRelationId = null): bool
    {
        $builder = $this->db->table($this->table)
            ->groupStart()
                ->groupStart()
                    ->where('document_id', $documentId)
                    ->where('related_document_id', $relatedDocumentId)
                ->groupEnd()
                ->orGroupStart()
                    ->where('document_id', $relatedDocumentId)
                    ->where('related_document_id', $documentId)
                ->groupEnd()
            ->groupEnd()
            ->where('relation_type_id', $relationTypeId);

        if ($excludeRelationId !== null) {
            $builder->where('relation_id !=', $excludeRelationId);
        }

        return $builder->countAllResults() > 0;
    }

    /**
     * Relasi yang boleh divalidasi oleh validator: validator punya scope atas salah satu dokumen (document_id atau related_document_id).
     */
    public function getRelationsForValidator(int $userId): array
    {
        return $this->relationValidatorScopeQuery($userId)
            ->orderBy('tbl_document_relations.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil satu relasi beserta info dokumen, hanya jika validator punya scope atas salah satu dokumennya.
     */
    public function findForValidator(int $userId, int $relationId): ?array
    {
        $row = $this->relationValidatorScopeQuery($userId)
            ->where('tbl_document_relations.relation_id', $relationId)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }

    private function relationValidatorScopeQuery(int $userId)
    {
        return $this->db->table($this->table)
            ->select('tbl_document_relations.*, tbl_document_relation_type.relation_name,
                d1.document_title AS document_title, d1.document_number AS document_number, d1.status AS document_status,
                d2.document_title AS related_document_title, d2.document_number AS related_document_number, d2.status AS related_document_status')
            ->join('tbl_document_relation_type', 'tbl_document_relation_type.relation_type_id = tbl_document_relations.relation_type_id', 'left')
            ->join('tbl_documents d1', 'd1.document_id = tbl_document_relations.document_id', 'left')
            ->join('tbl_documents d2', 'd2.document_id = tbl_document_relations.related_document_id', 'left')
            ->join('tbl_user_document_scope s1', 's1.scope_id = d1.scope_id AND (s1.fak_id <=> d1.fak_id) AND (s1.prodi_id <=> d1.prodi_id) AND s1.user_id = ' . $userId . ' AND s1.scope_status = 1', 'left')
            ->join('tbl_user_document_scope s2', 's2.scope_id = d2.scope_id AND (s2.fak_id <=> d2.fak_id) AND (s2.prodi_id <=> d2.prodi_id) AND s2.user_id = ' . $userId . ' AND s2.scope_status = 1', 'left')
            ->groupStart()
                ->where('s1.user_document_scope_id IS NOT NULL', null, false)
                ->orWhere('s2.user_document_scope_id IS NOT NULL', null, false)
            ->groupEnd()
            ->groupBy('tbl_document_relations.relation_id');
    }
}