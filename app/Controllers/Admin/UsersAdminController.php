<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\UserModel;

class UsersAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Users',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'users' => $this->userModel->findAll()
        ];

        return view('admin/v_users', $data);
    }
    public function insert()
    {
        // Validasi Email
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.user_email]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_email' => 'inputan harus berformat email',
                    'is_unique' => 'Email sudah terdaftar sebelumnya'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-email');
        };
        // Validasi password
        if (!$this->validate([
            'password' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'matches' => 'password konfirmasi tidak sama'
                ]
            ],
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error');
        };
        // Validasi foto
        if (!$this->validate([
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error-img');
        };
        // Validasi inputan lainnya
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                    // 'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'level' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan harus berformat angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/users/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        $nama = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $email = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
        $pass = htmlspecialchars($this->request->getPost('password'), ENT_QUOTES);
        $level = htmlspecialchars($this->request->getPost('level'), ENT_QUOTES);

        $this->userModel->save([
            'user_name' => $nama,
            'user_email' => $email,
            'user_password' => password_hash($pass, PASSWORD_DEFAULT),
            'user_level' => $level,
            'user_status' => 1,
            'user_photo' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/users')->with('msg', 'success');
    }
    
    public function update()
    {
        $user_id = $this->request->getPost('user_id');

        if (!$user_id || !$this->userModel->find($user_id)) {
            return redirect()->to('/admin/users')->with('msg', 'error-user-not-found');
        }

        // Ambil data user lama
        $user = $this->userModel->find($user_id);

        // Inisialisasi data update
        $updateData = [];

        // Validasi Email (jika ada perubahan)
        $user_id = htmlspecialchars($this->request->getPost('user_id'), ENT_QUOTES);
        $email = $this->request->getPost('email');

        if (!empty($email) && $email !== $user['user_email']) {
            if (!$this->validate([
                'email' => [
                    'rules' => "valid_email|is_unique[tbl_user.user_email,user_id,{$user_id}]",
                    'errors' => [
                        'valid_email' => 'Inputan harus berformat email',
                        'is_unique' => 'Email sudah digunakan oleh pengguna lain'
                    ]
                ]
            ])) {
                return redirect()->to('/admin/users')->with('msg', 'error-email');
            }
            $updateData['user_email'] = htmlspecialchars($email, ENT_QUOTES);
        }

        // Validasi Nama (jika ada perubahan)
        $nama = $this->request->getPost('nama');
        if (!empty($nama) && $nama !== $user['user_name']) {
            if (!$this->validate([
                'nama' => [
                    'rules' => 'alpha_space',
                    'errors' => [
                        'alpha_space' => 'Nama tidak boleh mengandung karakter aneh'
                    ]
                ]
            ])) {
                return redirect()->to('/admin/users')->with('msg', 'error-nama');
            }
            $updateData['user_name'] = htmlspecialchars($nama, ENT_QUOTES);
        }

        // Validasi Level (jika ada perubahan)
        $level = $this->request->getPost('level');
        if (!empty($level) && $level !== $user['user_level']) {
            if (!$this->validate([
                'level' => [
                    'rules' => 'numeric',
                    'errors' => [
                        'numeric' => 'Level harus berupa angka'
                    ]
                ]
            ])) {
                return redirect()->to('/admin/users')->with('msg', 'error-level');
            }
            $updateData['user_level'] = htmlspecialchars($level, ENT_QUOTES);
        }

        // Validasi dan Update Password (jika ada perubahan)
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['user_password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Validasi dan Update Foto (jika ada perubahan)
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            if (!$this->validate([
                'filefoto' => [
                    'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                        'is_image' => 'Yang Anda pilih bukan gambar',
                        'mime_in' => 'Yang Anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to('/admin/users')->with('msg', 'error-img');
            }

            // Hapus foto lama jika ada
            if ($user['user_photo'] && file_exists('assets/backend/images/users/' . $user['user_photo'])) {
                unlink('assets/backend/images/users/' . $user['user_photo']);
            }

            // Simpan foto baru
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/users/', $namaFotoUpload);
            $updateData['user_photo'] = $namaFotoUpload;
        }

        // Jika ada perubahan, lakukan update
        if (!empty($updateData)) {
            $this->userModel->update($user_id, $updateData);
        }

        return redirect()->to('/admin/users')->with('msg', 'info');
    }

    public function delete()
    {
        $user_id = $this->request->getPost('kode');
        $this->userModel->delete($user_id);
        return redirect()->to('/admin/users')->with('msg', 'success-delete');
    }
    public function activate($user_id)
    {
        $this->userModel->update($user_id, ['user_status' => 1]);
        return redirect()->to('/admin/users')->with('msg', 'success-activate');
    }
    public function deactivate($user_id)
    {
        $this->userModel->update($user_id, ['user_status' => 0]);
        return redirect()->to('/admin/users')->with('msg', 'success-deactivate');
    }
}
