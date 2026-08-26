<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\MemberModel;

class MemberAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->memberModel = new MemberModel();
    }

    public function index()
    {

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Member',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'members' => $this->memberModel->getAllMembers()
        ];

        return view('admin/v_member', $data);
    }

    public function insert()
    {
        if (!$this->validate([
            'nama' => [
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
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/member')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/member/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        // Simpan ke database
        $this->memberModel->save([
            'member_name' => $nama,
            'member_link' => $link,
            'member_desc' => $desc,
            'member_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/member')->with('msg', 'success');
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
            'link' => [
                'rules' => 'required|valid_url_strict',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/member')->with('msg', 'error');
        }
        $member_id = strip_tags(htmlspecialchars($this->request->getPost('member_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        
        // Cek Foto
        $member = $this->memberModel->find($member_id);
        $fotoAwal = $member['member_image'];
        $fileFoto = $this->request->getFile('filefoto');

        // Jika tidak ada file yang diunggah
        if ($fileFoto->getError() == UPLOAD_ERR_NO_FILE) {
            $namaFotoUpload = $fotoAwal; // Gunakan foto lama
        } else {
            // Hapus foto lama jika bukan foto default dan bukan sama dengan foto baru
            if ($fotoAwal != 'default-image.png' && $fotoAwal != $fileFoto->getName()) {
                $pathToFotoAwal = 'assets/backend/images/member/' . $fotoAwal;
                if (file_exists($pathToFotoAwal) && is_file($pathToFotoAwal)) {
                    unlink($pathToFotoAwal); // Hapus hanya jika itu adalah file, bukan direktori
                }
            }
            // Simpan gambar baru
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/member/', $namaFotoUpload);
        }

        // Simpan ke database
        $this->memberModel->update($member_id, [
            'member_name' => $nama,
            'member_link' => $link,
            'member_desc' => $desc,
            'member_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/member')->with('msg', 'info');
    }
    
    public function delete()
    {
        $member_id = $this->request->getPost('kode');
        $this->memberModel->delete($member_id);
        return redirect()->to('/admin/member')->with('msg', 'success-delete');
    }
}
