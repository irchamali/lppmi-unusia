<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\DocumentModel;
use App\Models\DocumentRelationModel;
use App\Models\DocumentRelationTypeModel;
use App\Models\InboxModel;
use App\Models\SiteModel;

class DocumentRelationManagerController extends BaseController
{
    protected $commentModel;
    protected $documentModel;
    protected $relationModel;
    protected $relationTypeModel;
    protected $inboxModel;
    protected $siteModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->documentModel = new DocumentModel();
        $this->relationModel = new DocumentRelationModel();
        $this->relationTypeModel = new DocumentRelationTypeModel();
        $this->inboxModel = new InboxModel();
        $this->siteModel = new SiteModel();
    }

    public function index()
    {
        $documents = $this->documentModel->getRelatableDocumentsForManager((int) session('id'));
        $documentIds = array_map(static fn (array $row): int => (int) $row['document_id'], $documents);

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Relations',
            'active' => 'document-relations',
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'documents' => $documents,
            'relationtypes' => $this->relationTypeModel->findAll(),
            'relations' => $this->relationModel->getManagedRelations($documentIds),
        ];

        return view('admin/v_document_relations', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'document_id' => [
                'rules' => 'required|numeric',
                'errors' => ['required' => 'Kolom {field} harus diisi!', 'numeric' => 'Kolom {field} tidak valid!']
            ],
            'related_document_id' => [
                'rules' => 'required|numeric',
                'errors' => ['required' => 'Kolom {field} harus diisi!', 'numeric' => 'Kolom {field} tidak valid!']
            ],
            'relation_type_id' => [
                'rules' => 'required|numeric',
                'errors' => ['required' => 'Kolom {field} harus diisi!', 'numeric' => 'Kolom {field} tidak valid!']
            ],
        ])) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error');
        }

        $documentId = (int) $this->request->getPost('document_id');
        $relatedId = (int) $this->request->getPost('related_document_id');
        $relationTypeId = (int) $this->request->getPost('relation_type_id');
        $notes = strip_tags(htmlspecialchars((string) $this->request->getPost('relation_notes'), ENT_QUOTES));

        if ($documentId === $relatedId) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-same-document');
        }

        if (!$this->canRelateDocuments($documentId, $relatedId)) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-scope');
        }

        if ($this->relationModel->relationExists($documentId, $relatedId, $relationTypeId)) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-duplicate');
        }

        $this->relationModel->save([
            'document_id' => $documentId,
            'related_document_id' => $relatedId,
            'relation_type_id' => $relationTypeId,
            'relation_notes' => $notes !== '' ? $notes : null,
            'created_by' => session('id'),
            'status' => 'submitted',
        ]);

        return redirect()->to('/manager/document-relations')->with('msg', 'success');
    }

    public function update()
    {
        $relationId = (int) $this->request->getPost('relation_id');
        $relation = $this->relationModel->find($relationId);

        if ($relation === null || !$this->canRelateDocuments((int) $relation['document_id'], (int) $relation['related_document_id'])) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-document-not-found');
        }

        if (!$this->validate([
            'relation_type_id' => [
                'rules' => 'required|numeric',
                'errors' => ['required' => 'Kolom {field} harus diisi!', 'numeric' => 'Kolom {field} tidak valid!']
            ],
        ])) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error');
        }

        $relationTypeId = (int) $this->request->getPost('relation_type_id');
        $notes = strip_tags(htmlspecialchars((string) $this->request->getPost('relation_notes'), ENT_QUOTES));

        if ($this->relationModel->relationExists((int) $relation['document_id'], (int) $relation['related_document_id'], $relationTypeId, $relationId)) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-duplicate');
        }

        $this->relationModel->update($relationId, [
            'relation_type_id' => $relationTypeId,
            'relation_notes' => $notes !== '' ? $notes : null,
            'status' => 'submitted',
            'validated_by' => null,
            'validated_at' => null,
            'validation_notes' => null,
        ]);

        return redirect()->to('/manager/document-relations')->with('msg', 'info');
    }

    public function delete()
    {
        $relationId = (int) $this->request->getPost('kode');
        $relation = $this->relationModel->find($relationId);

        if ($relation === null || !$this->canRelateDocuments((int) $relation['document_id'], (int) $relation['related_document_id'])) {
            return redirect()->to('/manager/document-relations')->with('msg', 'error-document-not-found');
        }

        $this->relationModel->delete($relationId);

        return redirect()->to('/manager/document-relations')->with('msg', 'success-delete');
    }

    private function canRelateDocuments(int $documentId, int $relatedId): bool
    {
        $allowedIds = array_map(
            static fn (array $row): int => (int) $row['document_id'],
            $this->documentModel->getRelatableDocumentsForManager((int) session('id'))
        );

        return in_array($documentId, $allowedIds, true) && in_array($relatedId, $allowedIds, true);
    }
}
