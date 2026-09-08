<?php

namespace App\Controllers\Validator;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\DocumentRelationModel;
use App\Models\InboxModel;
use App\Models\SiteModel;

class DocumentRelationValidatorController extends BaseController
{
    protected $commentModel;
    protected $relationModel;
    protected $inboxModel;
    protected $siteModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->relationModel = new DocumentRelationModel();
        $this->inboxModel = new InboxModel();
        $this->siteModel = new SiteModel();
    }

    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Relations Validation',
            'active' => 'document-relations',
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => [],
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => [],
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'relations' => $this->relationModel->getRelationsForValidator((int) session('id')),
        ];

        return view('admin/v_document_relations', $data);
    }

    public function validateRelation(int $relationId, string $status)
    {
        if (!in_array($status, ['approved', 'revised', 'rejected'], true)) {
            return redirect()->to('/validator/document-relations');
        }

        $relation = $this->relationModel->findForValidator((int) session('id'), $relationId);

        if ($relation === null || $relation['status'] !== 'submitted') {
            return redirect()->to('/validator/document-relations')->with('msg', 'error-document-not-found');
        }

        $notes = trim((string) ($this->request->getPost('validation_notes') ?? ''));
        if (in_array($status, ['revised', 'rejected'], true) && $notes === '') {
            return redirect()->to('/validator/document-relations')->with('msg', 'error-validation-notes');
        }

        $updated = $this->relationModel->update($relationId, [
            'status' => $status,
            'validated_by' => session('id'),
            'validated_at' => date('Y-m-d H:i:s'),
            'validation_notes' => strip_tags(htmlspecialchars($notes, ENT_QUOTES)) ?: null,
        ]);

        if (!$updated) {
            return redirect()->to('/validator/document-relations')->with('msg', 'error-validation');
        }

        return redirect()->to('/validator/document-relations')->with('msg', 'success');
    }
}
