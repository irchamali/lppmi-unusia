<?php

namespace App\Controllers\Validator;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\DocumentModel;
use App\Models\InboxModel;
use App\Models\ProdiModel;
use App\Models\SiteModel;

class DocumentValidatorController extends BaseController
{
    protected $commentModel;
    protected $documentModel;
    protected $inboxModel;
    protected $prodiModel;
    protected $siteModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->documentModel = new DocumentModel();
        $this->inboxModel = new InboxModel();
        $this->prodiModel = new ProdiModel();
        $this->siteModel = new SiteModel();
    }

    public function index()
    {
        return view('admin/v_document', [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Validation',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => [],
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => [],
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => [],
            'scopes' => [],
            'types' => [],
            'fakultas' => $this->prodiModel->db->table('tbl_fakultas')->orderBy('fak_name', 'ASC')->get()->getResultArray(),
            'prodi' => $this->prodiModel->orderBy('prodi_nama', 'ASC')->findAll(),
            'documents' => $this->documentModel->getDocumentsForValidator((int) session('id'))
        ]);
    }

    public function dashboard()
    {
        $documents = $this->documentModel->getDocumentsForValidator((int) session('id'));

        return view('admin/v_document_dashboard', [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Validator Dashboard',
            'active' => 'dashboard',
            'total_inbox' => 0,
            'inboxs' => [],
            'total_comment' => 0,
            'comments' => [],
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'dashboard' => $this->documentModel->summarizeDocuments($documents),
            'documentUrl' => '/validator/document',
        ]);
    }

    public function validateDocument(int $documentId, string $status)
    {
        if (!in_array($status, ['approved', 'revised', 'rejected'], true)) {
            return redirect()->to('/validator/document');
        }

        $document = $this->documentModel->find($documentId);
        if ($document === null || $document['status'] !== 'submitted' || !$this->documentModel->userHasDocumentScope(
            (int) session('id'),
            (int) $document['scope_id'],
            $document['fak_id'] === null ? null : (int) $document['fak_id'],
            $document['prodi_id'] === null ? null : (int) $document['prodi_id']
        )) {
            return redirect()->to('/validator/document')->with('msg', 'error-document-not-found');
        }

        $notes = trim((string) ($this->request->getPost('validation_notes') ?? ''));
        if (in_array($status, ['revised', 'rejected'], true) && $notes === '') {
            return redirect()->to('/validator/document')->with('msg', 'error-validation-notes');
        }
        $updated = $this->documentModel->builder()
            ->where('document_id', $documentId)
            ->update([
            'status' => $status,
            'validated_by' => session('id'),
            'validated_at' => date('Y-m-d H:i:s'),
            'validation_notes' => strip_tags(htmlspecialchars($notes, ENT_QUOTES)) ?: null
            ]);

        if (!$updated) {
            return redirect()->to('/validator/document')->with('msg', 'error-validation');
        }

        return redirect()->to('/validator/document')->with('msg', 'success');
    }
}