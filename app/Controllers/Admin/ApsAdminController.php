<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\ApsModel;
use App\Models\ProdiModel;

class ApsAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->apsModel = new ApsModel();
        $this->prodiModel = new ProdiModel();
    }
    public function index()
    {

        $data = [
            'akun' => $this->akun,
            'title' => 'Data Akreditasi',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'studies' => $this->prodiModel->findAll(),
            'aps' => $this->apsModel->findAll()
            // 'pstudies' => $this->apsModel->getAllAps()->getResultArray()
        ];

        return view('admin/v_akreditasi', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi angka!',
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'sk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'tahun' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi angka tahun!',
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'peringkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'kadaluarsa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ]
        ])) {
            return redirect()->to('/admin/akreditasi')->with('msg', 'error');
        }
        
        $prodi = strip_tags(htmlspecialchars($this->request->getPost('prodi'), ENT_QUOTES));
        $sk = strip_tags(htmlspecialchars($this->request->getPost('sk'), ENT_QUOTES));
        $tahun = strip_tags(htmlspecialchars($this->request->getPost('tahun'), ENT_QUOTES));
        $peringkat = strip_tags(htmlspecialchars($this->request->getPost('peringkat'), ENT_QUOTES)); 
        $kadaluarsa = strip_tags(htmlspecialchars($this->request->getPost('kadaluarsa'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        // Simpan ke database
        $this->apsModel->save([
            'prodi_id' => $prodi,
            'no_sk' => $sk,
            'thn_sk' => $tahun,
            'peringkat' => $peringkat,
            'tgl_kadaluarsa' => $kadaluarsa,
            'aps_link' => $link
            
        ]);
        return redirect()->to('/admin/akreditasi')->with('msg', 'success');
    }
    public function update()
    {
        $aps_id = $this->request->getPost('aps_id'); 
        // Validasi
        if (!$this->validate([
            'prodi' => [
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
            'tahun' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi angka tahun!',
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'peringkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'kadaluarsa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ]
        ])) {
            return redirect()->to('/admin/akreditasi')->with('msg', 'error');
        }
        $prodi = strip_tags(htmlspecialchars($this->request->getPost('prodi'), ENT_QUOTES));
        $sk = strip_tags(htmlspecialchars($this->request->getPost('sk'), ENT_QUOTES));
        $tahun = strip_tags(htmlspecialchars($this->request->getPost('tahun'), ENT_QUOTES));
        $peringkat = strip_tags(htmlspecialchars($this->request->getPost('peringkat'), ENT_QUOTES)); 
        $kadaluarsa = strip_tags(htmlspecialchars($this->request->getPost('kadaluarsa'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        // Cek Foto

        //print_r($category);die();

        $this->apsModel->update($aps_id, [
            'prodi_id' => $prodi,
            'no_sk' => $sk,
            'thn_sk' => $tahun,
            'peringkat' => $peringkat,
            'tgl_kadaluarsa' => $kadaluarsa,
            'aps_link' => $link
            
        ]);
        return redirect()->to('/admin/akreditasi')->with('msg', 'info');
    }
    
    public function delete()
    {
        $aps_id = $this->request->getPost('kode');
        $this->apsModel->delete($aps_id);
        return redirect()->to('/admin/akreditasi')->with('msg', 'success-delete');
    }
}
