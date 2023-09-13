<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class ProdiAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->prodiModel = new ProdiModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Daftar Program Studi',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'pstudies' => $this->prodiModel->findAll()
        ];

        return view('admin/v_prodi', $data);
    }
    
    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $prodi    = strip_tags(htmlspecialchars($this->request->getPost('prodiedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $prodi);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $kodeps   = strip_tags(htmlspecialchars($this->request->getPost('kodeps'), ENT_QUOTES));
        $strata   = strip_tags(htmlspecialchars($this->request->getPost('strata'), ENT_QUOTES));
        $this->prodiModel->save([
            'prodi_id' => $id,
            'prodi_nama' => $prodi,
            'prodi_slug' => $slug,
            'prodi_kode' => $kodeps,
            'prodi_strata' => $strata
        ]);
        return redirect()->to('admin/prodi')->with('msg', 'info');
    }

    public function update()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'strata' => [
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
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Kolom {field} harus berformat email'
                ]
            ]
        ])) {
            return redirect()->to('/admin/prodi')->with('msg', 'error');
        }
        $prodi_id = strip_tags(htmlspecialchars($this->request->getPost('prodi_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $kode = strip_tags(htmlspecialchars($this->request->getPost('kode'), ENT_QUOTES));
        $strata = strip_tags(htmlspecialchars($this->request->getPost('strata'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $email = strip_tags(htmlspecialchars($this->request->getPost('email'), ENT_QUOTES));
        // Cek Foto
        $prodi = $this->prodiModel->find($prodi_id);
        // $fotoAwal = $slider['slider_image'];
        // $fileFoto = $this->request->getFile('filefoto');
        // if ($fileFoto->getName() == '') {
        //     $namaFotoUpload = $fotoAwal;
        // } else {
        //     $namaFotoUpload = $fileFoto->getRandomName();
        //     $fileFoto->move('assets/backend/images/slider/', $namaFotoUpload);
        // }
        // Simpan ke database
        $this->prodiModel->update($prodi_id, [
            'prodi_nama' => $nama,
            'prodi_kode' => $kode,
            'prodi_strata' => $strata,
            'prodi_link' => $link,
            'prodi_email' => $email
        ]);
        return redirect()->to('/admin/prodi')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->prodiModel->delete($id);

        return redirect()->to('admin/prodi')->with('msg', 'success-delete');
    }

    public function insert(){
        $id       = $this->request->getPost('id');
        $prodi    = strip_tags(htmlspecialchars($this->request->getPost('prodiadd'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $prodi);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $kodeps   = strip_tags(htmlspecialchars($this->request->getPost('kodeps'), ENT_QUOTES));
        $strata   = strip_tags(htmlspecialchars($this->request->getPost('strata'), ENT_QUOTES));
        $this->prodiModel->save([
            'prodi_nama' => $prodi,
            'prodi_slug' => $slug,
            'prodi_kode' => $kodeps,
            'prodi_strata' => $strata
        ]);

        return redirect()->to('admin/prodi')->with('msg', 'success');
    }
}
