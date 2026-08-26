<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PublikasiModel;
use App\Models\PudosCategoryModel;

class PudosAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $publikasiModel;
    protected $pudoscategoryModel;
    protected $active; // Tambahkan properti ini

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->siteModel = new SiteModel();
        $this->commentModel = new CommentModel();
        $this->publikasiModel = new PublikasiModel();
        $this->pudoscategoryModel = new PudoscategoryModel();
        $this->active = 'publikasi'; // Atur nilai default atau sesuai kebutuhan Anda
    }
    public function index()
    {

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Semua Publikasi',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->pudoscategoryModel->findAll(),
            'documents' => $this->publikasiModel->findAll()
        ];

        return view('admin/v_publikasi', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'publisher' => [
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
            return redirect()->to('/admin/publikasi')->with('msg', 'error');
        }
        
        $judul = strip_tags(htmlspecialchars($this->request->getPost('judul'), ENT_QUOTES));
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $publisher = strip_tags(htmlspecialchars($this->request->getPost('publisher'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES)); 
        // Simpan ke database
        $this->publikasiModel->save([
            'pudos_title' => $judul,
            'pudos_name' => $name,
            'pudos_publisher' => $publisher,
            'pudos_year' => $year,
            'pudos_link' => $link,
            'pudos_category_id' => $category
            
        ]);
        return redirect()->to('/admin/publikasi')->with('msg', 'success');
    }
    public function update()
    {
        $pudos_id = $this->request->getPost('pudos_id'); 
        // Validasi
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'publisher' => [
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
            return redirect()->to('/admin/publikasi')->with('msg', 'error');
        }
        $pudos_id = strip_tags(htmlspecialchars($this->request->getPost('pudos_id'), ENT_QUOTES));
        $judul = strip_tags(htmlspecialchars($this->request->getPost('judul'), ENT_QUOTES));
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $publisher = strip_tags(htmlspecialchars($this->request->getPost('publisher'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        // Cek Foto

        //print_r($category);die();

        $this->publikasiModel->update($pudos_id, [
            'pudos_title' => $judul,
            'pudos_name' => $name,
            'pudos_publisher' => $publisher,
            'pudos_year' => $year,
            'pudos_link' => $link,
            'pudos_category_id' => $category
            
        ]);
        return redirect()->to('/admin/publikasi')->with('msg', 'info');
    }
    
    public function delete()
    {
        $pudos_id = $this->request->getPost('kode');
        $this->publikasiModel->delete($pudos_id);
        return redirect()->to('/admin/publikasi')->with('msg', 'success-delete');
    }
}
