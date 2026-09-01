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

class DocsAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $siteModel;
    protected $documentModel;
    protected $docscategoryModel;
    protected $scopeModel;
    protected $typeModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->documentModel = new DocumentModel();
        $this->docscategoryModel = new DocumentCategoryModel();
        $this->scopeModel = new DocumentScopeModel();
        $this->typeModel = new DocumentTypeModel();
    }
    public function index()
    {

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
            'documents'  => $this->documentModel->getAllDocuments()
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
            return redirect()->to('/admin/document')->with('msg', 'error');
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
            'ppepp_stage'    => strip_tags(htmlspecialchars($this->request->getPost('ppepp_stage'), ENT_QUOTES)) ?: null,
            'user_id'        => session('user_id') ?: 1, // Default 1 if no session user_id for safety
            'status'         => 'submitted'

        ]);
        return redirect()->to('/admin/document')->with('msg', 'success');
    }
    public function update()
    {
        $document_id = $this->request->getPost('document_id');
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
            return redirect()->to('/admin/document')->with('msg', 'error');
        }

        $this->documentModel->update($document_id, [
            'document_title' => strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES)),
            'document_number'=> strip_tags(htmlspecialchars($this->request->getPost('number'), ENT_QUOTES)),
            'document_date'  => strip_tags(htmlspecialchars($this->request->getPost('date'), ENT_QUOTES)),
            'document_file'  => strip_tags(htmlspecialchars($this->request->getPost('file_link'), ENT_QUOTES)),
            'category_id'    => strip_tags(htmlspecialchars($this->request->getPost('category_id'), ENT_QUOTES)),
            'type_id'        => strip_tags(htmlspecialchars($this->request->getPost('type_id'), ENT_QUOTES)),
            'scope_id'       => strip_tags(htmlspecialchars($this->request->getPost('scope_id'), ENT_QUOTES)),
            'ppepp_stage'    => strip_tags(htmlspecialchars($this->request->getPost('ppepp_stage'), ENT_QUOTES)) ?: null
            
        ]);
        return redirect()->to('/admin/document')->with('msg', 'info');
    }
    
    public function delete()
    {
        $document_id = $this->request->getPost('kode');
        $this->documentModel->delete($document_id);
        return redirect()->to('/admin/document')->with('msg', 'success-delete');
    }
}
