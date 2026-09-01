<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\SiteModel;
use App\Models\DocumentModel;
use App\Models\DocumentCategoryModel;
use App\Models\DocumentScopeModel;
use App\Models\DocumentTypeModel;
use App\Models\ProdiModel;

class DocsAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $siteModel;
    protected $documentModel;
    protected $docscategoryModel;
    protected $scopeModel;
    protected $typeModel;
    protected $prodiModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->documentModel = new DocumentModel();
        $this->docscategoryModel = new DocumentCategoryModel();
        $this->scopeModel = new DocumentScopeModel();
        $this->typeModel = new DocumentTypeModel();
        $this->prodiModel = new ProdiModel();
    }
    public function index()
    {
        $documents = session('role') === 'manager'
            ? $this->documentModel->getDocumentsByUser((int) session('id'))
            : $this->documentModel->getAllDocuments();

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Document',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->docscategoryModel->findAll(),
            'scopes'     => $this->scopeModel->findAll(),
            'types'      => $this->typeModel->findAll(),
            'fakultas'   => $this->prodiModel->db->table('tbl_fakultas')->orderBy('fak_name', 'ASC')->get()->getResultArray(),
            'prodi'      => $this->prodiModel->orderBy('prodi_nama', 'ASC')->findAll(),
            'documents'  => $documents
        ];

        return view('admin/v_document', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'file_link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'type_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'scope_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to($this->documentPath())->with('msg', 'error');
        }
        $unitData = $this->getUnitData();
        if ($unitData === null || !$this->canSubmitToUnit($unitData)) {
            return redirect()->to($this->documentPath())->with('msg', 'error-unit');
        }

        // Simpan ke database
        $this->documentModel->save([
            'document_title' => strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES)),
            'document_number'=> strip_tags(htmlspecialchars($this->request->getPost('number'), ENT_QUOTES)),
            'document_date'  => strip_tags(htmlspecialchars($this->request->getPost('date'), ENT_QUOTES)),
            'document_file'  => strip_tags(htmlspecialchars($this->request->getPost('file_link'), ENT_QUOTES)),
            'category_id'    => strip_tags(htmlspecialchars($this->request->getPost('category_id'), ENT_QUOTES)),
            'type_id'        => strip_tags(htmlspecialchars($this->request->getPost('type_id'), ENT_QUOTES)),
            'scope_id'       => strip_tags(htmlspecialchars($this->request->getPost('scope_id'), ENT_QUOTES)),
            'fak_id'         => $unitData['fak_id'],
            'prodi_id'       => $unitData['prodi_id'],
            'document_description' => strip_tags(htmlspecialchars($this->request->getPost('document_description'), ENT_QUOTES)),
            'ppepp_stage'    => strip_tags(htmlspecialchars($this->request->getPost('ppepp_stage'), ENT_QUOTES)) ?: null,
            'user_id'        => session('id'),
            'status'         => 'submitted'

        ]);
        return redirect()->to($this->documentPath())->with('msg', 'success');
    }
    public function update()
    {
        $document_id = $this->request->getPost('document_id');
        if (!$this->canManageDocument($document_id)) {
            return redirect()->to($this->documentPath())->with('msg', 'error-document-not-found');
        }
        // Validasi
        if (!$this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'file_link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'category_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'type_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'scope_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ]
        ])) {
            return redirect()->to($this->documentPath())->with('msg', 'error');
        }
        $unitData = $this->getUnitData();
        if ($unitData === null || !$this->canSubmitToUnit($unitData)) {
            return redirect()->to($this->documentPath())->with('msg', 'error-unit');
        }

        $this->documentModel->update($document_id, [
            'document_title' => strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES)),
            'document_number'=> strip_tags(htmlspecialchars($this->request->getPost('number'), ENT_QUOTES)),
            'document_date'  => strip_tags(htmlspecialchars($this->request->getPost('date'), ENT_QUOTES)),
            'document_file'  => strip_tags(htmlspecialchars($this->request->getPost('file_link'), ENT_QUOTES)),
            'category_id'    => strip_tags(htmlspecialchars($this->request->getPost('category_id'), ENT_QUOTES)),
            'type_id'        => strip_tags(htmlspecialchars($this->request->getPost('type_id'), ENT_QUOTES)),
            'scope_id'       => strip_tags(htmlspecialchars($this->request->getPost('scope_id'), ENT_QUOTES)),
            'fak_id'         => $unitData['fak_id'],
            'prodi_id'       => $unitData['prodi_id'],
            'document_description' => strip_tags(htmlspecialchars($this->request->getPost('document_description'), ENT_QUOTES)),
            'ppepp_stage'    => strip_tags(htmlspecialchars($this->request->getPost('ppepp_stage'), ENT_QUOTES)) ?: null,
            'status'         => session('role') === 'manager' ? 'submitted' : $this->documentModel->find($document_id)['status'],
            'validated_by'   => session('role') === 'manager' ? null : $this->documentModel->find($document_id)['validated_by'],
            'validated_at'   => session('role') === 'manager' ? null : $this->documentModel->find($document_id)['validated_at'],
            'validation_notes' => session('role') === 'manager' ? null : $this->documentModel->find($document_id)['validation_notes']
            
        ]);
        return redirect()->to($this->documentPath())->with('msg', 'info');
    }
    
    public function delete()
    {
        $document_id = $this->request->getPost('kode');
        if (!$this->canManageDocument($document_id)) {
            return redirect()->to($this->documentPath())->with('msg', 'error-document-not-found');
        }
        $this->documentModel->delete($document_id);
        return redirect()->to($this->documentPath())->with('msg', 'success-delete');
    }
    protected function documentPath(): string
    {
        return '/' . session('role') . '/document';
    }
    protected function canManageDocument($documentId): bool
    {
        $document = $this->documentModel->find($documentId);

        return $document !== null && (session('role') !== 'manager' || (int) $document['user_id'] === (int) session('id'));
    }
    protected function getUnitData(): ?array
    {
        $scope = $this->scopeModel->find($this->request->getPost('scope_id'));
        if ($scope === null) {
            return null;
        }

        $scopeSlug = strtolower($scope['scope_slug']);
        $requiresFakultas = str_contains($scopeSlug, 'fakultas') || str_contains($scopeSlug, 'prodi');
        $requiresProdi = str_contains($scopeSlug, 'prodi');
        $fakultasId = (int) $this->request->getPost('fak_id');
        $prodiId = (int) $this->request->getPost('prodi_id');

        if (!$requiresFakultas) {
            return ['scope_id' => (int) $scope['scope_id'], 'fak_id' => null, 'prodi_id' => null];
        }
        if ($fakultasId < 1 || !$this->prodiModel->db->table('tbl_fakultas')->where('fak_id', $fakultasId)->countAllResults()) {
            return null;
        }
        if (!$requiresProdi) {
            return ['scope_id' => (int) $scope['scope_id'], 'fak_id' => $fakultasId, 'prodi_id' => null];
        }
        if ($prodiId < 1 || !$this->prodiModel->where(['prodi_id' => $prodiId, 'fak_id' => $fakultasId])->first()) {
            return null;
        }

        return ['scope_id' => (int) $scope['scope_id'], 'fak_id' => $fakultasId, 'prodi_id' => $prodiId];
    }
    protected function canSubmitToUnit(array $unitData): bool
    {
        return session('role') !== 'manager' || $this->documentModel->userHasDocumentScope(
            (int) session('id'),
            $unitData['scope_id'],
            $unitData['fak_id'],
            $unitData['prodi_id']
        );
    }
}
