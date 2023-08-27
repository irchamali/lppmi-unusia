<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\LaporanModel;
use App\Models\LapCategoryModel;

class LapAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->laporanModel = new LaporanModel();
        $this->lapcategoryModel = new LapcategoryModel();
    }
    public function index()
    {

        $data = [
            'akun' => $this->akun,
            'title' => 'Semua Laporan',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->lapcategoryModel->findAll(),
            'laporan' => $this->laporanModel->findAll()
        ];

        return view('admin/v_laporan', $data);
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
            return redirect()->to('/admin/laporan')->with('msg', 'error');
        }
        
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $unit = strip_tags(htmlspecialchars($this->request->getPost('unit'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES)); 
        // Simpan ke database
        $this->laporanModel->save([
            'lap_name' => $name,
            'lap_unit' => $unit,
            'lap_year' => $year,
            'lap_link' => $link,
            'lap_category_id' => $category
            
        ]);
        return redirect()->to('/admin/laporan')->with('msg', 'success');
    }
    public function update()
    {
        $lap_id = $this->request->getPost('lap_id'); 
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
            return redirect()->to('/admin/laporan')->with('msg', 'error');
        }
        $lap_id = strip_tags(htmlspecialchars($this->request->getPost('lap_id'), ENT_QUOTES));
        $name = strip_tags(htmlspecialchars($this->request->getPost('name'), ENT_QUOTES));
        $unit = strip_tags(htmlspecialchars($this->request->getPost('unit'), ENT_QUOTES));
        $year = strip_tags(htmlspecialchars($this->request->getPost('year'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        // Cek Foto

        //print_r($category);die();

        $this->laporanModel->update($lap_id, [
            'lap_name' => $name,
            'lap_unit' => $unit,
            'lap_year' => $year,
            'lap_link' => $link,
            'lap_category_id' => $category
            
        ]);
        return redirect()->to('/admin/laporan')->with('msg', 'info');
    }
    
    public function delete()
    {
        $lap_id = $this->request->getPost('kode');
        $this->laporanModel->delete($lap_id);
        return redirect()->to('/admin/laporan')->with('msg', 'success-delete');
    }
}
