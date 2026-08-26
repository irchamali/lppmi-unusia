<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PartnerAdminModel;
use App\Models\PartnerCategoryModel;

class PartnerAdminController extends BaseController
{
    protected $partnerModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->partnerModel = new PartnerAdminModel();
        $this->categoryModel = new PartnerCategoryModel();

        $this->akun = session()->get('akun');
        $this->active = 'partner';
    }
    public function index()
    {

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Partner',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->categoryModel->findAll(), // Tambahkan ini
            'partners' => $this->partnerModel->getAllPartners()
        ];

        return view('admin/v_partners', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'link' => [
                'rules' => 'permit_empty|valid_url_strict',
                'errors' => [
                    // 'required' => 'Kolom {field} harus diisi!',
                    'valid_url_strict' => 'inputan harus berupa link'
                ]
            ],
            'date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD)'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan harus angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/partner')->with('msg', 'error');
        }

        $uploadedImage = $this->request->getFile('filefoto');
        if ($uploadedImage && $uploadedImage->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $this->validate([
                'filefoto' => [
                    'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ],
            ])) {
                return redirect()->to('/admin/partner')->with('msg', 'error')->withInput();
            }
        }

        // Cek apakah ada file gambar yang diunggah
        if ($this->request->getFile('filefoto')->isValid()) {
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();

            // Simpan dan kompres gambar
            \Config\Services::image()
                ->withFile($fotoUpload)
                ->resize(800, 346, true)
                ->save('assets/backend/images/partners/' . $namaFotoUpload);
        } else {
            $namaFotoUpload = 'default-partners.png';
        }

        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        $date = strip_tags(htmlspecialchars($this->request->getPost('date'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        // Simpan ke database
        $this->partnerModel->save([
            'partner_name' => $nama,
            'partner_link' => $link,
            'partner_desc' => $desc,
            'partner_date' => $date,
            'category_id' => $category,
            'partner_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/partner')->with('msg', 'success');
    }
    public function update()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'link' => [
                'rules' => 'permit_empty|valid_url_strict',
                'errors' => [
                    'valid_url_strict' => 'Inputan harus berupa link yang valid'
                ]
            ],
            'date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD)'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'Inputan harus angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/partner')->with('msg', 'error');
        }

        $uploadedImage = $this->request->getFile('filefoto');
        if ($uploadedImage && $uploadedImage->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $this->validate([
                'filefoto' => [
                    'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ],
            ])) {
                return redirect()->to('/admin/partner')->with('msg', 'error')->withInput();
            }
        }
        $partner_id = strip_tags(htmlspecialchars($this->request->getPost('partner_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        $date = strip_tags(htmlspecialchars($this->request->getPost('date'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        // Cek Foto
        $partner = $this->partnerModel->find($partner_id);
        $fotoAwal = $partner['partner_image'];
        $fileFoto = $this->request->getFile('filefoto');
        // Jika tidak ada file yang diunggah
        if ($fileFoto->getError() == UPLOAD_ERR_NO_FILE) {
            $namaFotoUpload = $fotoAwal; // Gunakan foto lama
        } else {
            // Hapus foto lama jika bukan foto default dan bukan sama dengan foto baru
            if ($fotoAwal != 'default-partners.png' && $fotoAwal != $fileFoto->getName()) {
                $pathToFotoAwal = 'assets/backend/images/partners/' . $fotoAwal;
                if (file_exists($pathToFotoAwal) && is_file($pathToFotoAwal)) {
                    unlink($pathToFotoAwal); // Hapus hanya jika itu adalah file, bukan direktori
                }
            }
            // Simpan gambar baru
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/partners/', $namaFotoUpload);
        }

        // validasi: Cek apakah link sudah digunakan oleh data lain
        if (!empty($link)) {
            $existing = $this->partnerModel
                ->where('partner_link', $link)
                ->where('partner_id !=', $partner_id) // penting!
                ->first();
            if ($existing) {
                return redirect()->to('/admin/partner')->with('msg', 'error');
            }
        }

        // Simpan ke database
        $this->partnerModel->update($partner_id, [
            'partner_name' => $nama,
            'partner_link' => $link,
            'partner_desc' => $desc,
            'partner_date' => $date,
            'category_id' => $category,
            'partner_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/partner')->with('msg', 'info');
    }
    public function delete()
    {
        $partner_id = $this->request->getPost('kode');
        $this->partnerModel->delete($partner_id);
        return redirect()->to('/admin/partner')->with('msg', 'success-delete');
    }
    public function toggle_status($id) 
    {
        $this->partnerModel->togglePartnerStatus($id);

        return redirect()->to('/admin/partner')->with('msg', 'info');
    }
}
