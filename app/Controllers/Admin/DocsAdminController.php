<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\DocumentModel;
use App\Models\DocsCategoryModel;

class DocsAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->documentModel = new DocumentModel();
        $this->docscategoryModel = new DocscategoryModel();
    }
    public function index()
    {

        $data = [
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
            'documents' => $this->documentModel->findAll()
        ];

        return view('admin/v_document', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'sk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'year' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi angka tahun!',
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'category' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('/admin/document')->with('msg', 'error');
        }
        
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $unit = strip_tags(htmlspecialchars($this->request->getPost('unit'), ENT_QUOTES));
        $sk = strip_tags(htmlspecialchars($this->request->getPost('sk'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES)); 
        // Simpan ke database
        $this->documentModel->save([
            'docs_name' => $name,
            'docs_unit' => $unit,
            'docs_sk'   => $sk,
            'docs_year' => $year,
            'docs_link' => $link,
            'docs_category_id' => $category
            
        ]);
        return redirect()->to('/admin/document')->with('msg', 'success');
    }
    public function update()
    {
        $docs_id = $this->request->getPost('docs_id'); 
        // Validasi
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'sk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'year' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/document')->with('msg', 'error');
        }
        $docs_id = strip_tags(htmlspecialchars($this->request->getPost('docs_id'), ENT_QUOTES));
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $unit = strip_tags(htmlspecialchars($this->request->getPost('unit'), ENT_QUOTES));
        $sk   = strip_tags(htmlspecialchars($this->request->getPost('sk'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        // Cek Foto

        //print_r($category);die();

        $this->documentModel->update($docs_id, [
            'docs_name' => $name,
            'docs_unit' => $unit,
            'docs_sk'   => $sk,
            'docs_year' => $year,
            'docs_link' => $link,
            'docs_category_id' => $category
            
        ]);
        return redirect()->to('/admin/document')->with('msg', 'info');
    }
    
    public function delete()
    {
        $docs_id = $this->request->getPost('kode');
        $this->documentModel->delete($docs_id);
        return redirect()->to('/admin/document')->with('msg', 'success-delete');
    }
}
