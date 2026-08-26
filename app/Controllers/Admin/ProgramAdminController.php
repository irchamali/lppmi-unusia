<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\InboxModel;
use App\Models\CommentModel;
use App\Models\ProgramAdminModel;
use App\Models\ProgramCategoryModel;

class ProgramAdminController extends BaseController
{
    protected $programModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->siteModel = new SiteModel();
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->programModel = new ProgramAdminModel();
        $this->categoryModel = new ProgramCategoryModel();

        $this->akun = session()->get('akun');
        $this->active = 'program';
    }

    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Program', // Sesuaikan dengan sidebar
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->categoryModel->findAll(), // Tambahkan ini
            'programs' => $this->programModel->getAllPrograms(),
        ];

        return view('admin/v_programs', $data);
    }

    public function add_new()
    {
        $categories = $this->categoryModel->findAll();
        if ($categories === []) {
            $categories = $this->categoryModel->getAllCategoriesWithPrograms();
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Add New Program',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $categories
        ];
        return view('admin/v_program_add', $data);
    }

    public function publish()
    {
        if (!$this->validate([
            'program_title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'min_length' => 'Judul minimal 3 karakter',
                    'max_length' => 'Judul maksimal 255 karakter'
                ]
            ],
            'slug' => [
                'rules' => 'required|alpha_dash|is_unique[tbl_programs.program_slug]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'Inputan harus berupa alfabet dan strip',
                    'is_unique' => 'Slug sudah digunakan, silakan pilih yang lain'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'program_date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD)'
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
            return redirect()->to('/admin/program/add_new')->withInput()->with('peringatan', 'Data gagal disimpan karena ada inputan yang tidak sesuai. Silakan coba lagi!');
        }

        $uploadedImage = $this->request->getFile('filefoto');
        if ($uploadedImage && $uploadedImage->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $this->validate([
                'filefoto' => [
                    'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                        'is_image' => 'Yang Anda pilih bukan gambar',
                        'mime_in' => 'Yang Anda pilih bukan gambar'
                    ]
                ],
            ])) {
                return redirect()->to('/admin/program/add_new')->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan file gambar tidak valid.');
            }
        }

        // Cek apakah ada file gambar yang diunggah
        if ($this->request->getFile('filefoto')->isValid()) {
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();

            // Simpan dan kompres gambar
            \Config\Services::image()
                ->withFile($fotoUpload)
                ->resize(1000, 800, true)
                ->save('assets/backend/images/programs/' . $namaFotoUpload);
        } else {
            $namaFotoUpload = 'default-program.png';
        }

        // Ambil data dari input form
        $programTitle = strip_tags(htmlspecialchars($this->request->getPost('program_title'), ENT_QUOTES));
        $description = $this->request->getPost('description');
        $programDate = strip_tags(htmlspecialchars($this->request->getPost('program_date'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));

        // Jika slug sudah ada, tambahkan angka unik
        if ($this->programModel->where('program_slug', $slug)->countAllResults() > 0) {
            $uniqueNum = rand(1, 999);
            $slug = $slug . '-' . $uniqueNum;
        }

        // Simpan ke database
        $this->programModel->save([
            'program_title' => $programTitle,
            'program_description' => $description,
            'program_image' => $namaFotoUpload,
            'program_date' => $programDate, // Menyimpan tanggal program
            'category_id' => $category,
            'program_slug' => $slug,
            'program_status' => 1 // 1 = aktif
        ]);

        return redirect()->to('/admin/program')->with('msg', 'success');
    }

    public function delete()
    {
        $program_id = $this->request->getPost('id');
        $this->programModel->delete($program_id);
        return redirect()->to('/admin/program')->with('msg', 'success-delete');
    }

    public function toggle_status($id) 
    {
        $this->programModel->toggleProgramStatus($id);

        return redirect()->to('/admin/program')->with('msg', 'Status updated');
    }

    public function edit($id)
    {
        $program = $this->programModel->find($id);
        $categories = $this->categoryModel->findAll();
        if ($categories === []) {
            $categories = $this->categoryModel->getAllCategoriesWithPrograms();
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Edit Program',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $categories,
            'program' => $program
        ];
        return view('admin/v_program_edit', $data);
    }
    
    public function update()
    {
        $program_id = $this->request->getPost('program_id');
        // Validasi
        if (!$this->validate([
            'program_title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'min_length' => 'Judul minimal 3 karakter',
                    'max_length' => 'Judul maksimal 255 karakter'
                ]
            ],
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'inputan harus berupa alphaber dan strip'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'program_date' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD)'
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
            return redirect()->to("/admin/program/$program_id/edit")->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan ada penginputan yang tidak sesuai. silakan coba lagi!');
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
                return redirect()->to("/admin/program/$program_id/edit")->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan file gambar tidak valid.');
            }
        }
        
        // Ambil data dari input form
        $programTitle = strip_tags(htmlspecialchars($this->request->getPost('program_title'), ENT_QUOTES));
        $description = $this->request->getPost('description');
        $programDate = strip_tags(htmlspecialchars($this->request->getPost('program_date'), ENT_QUOTES));
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
        
        // Cek foto
        $programAwal = $this->programModel->find($program_id);
        $fotoAwal = $programAwal['program_image'];
        $programStatus = $programAwal['program_status'];
        $fileFoto = $this->request->getFile('filefoto');
        $slugLama = $programAwal['program_slug']; // pertahankan slug lama

        // Jika slug berubah, baru cek unik
        if ($slug !== $slugLama) {
            if ($this->programModel->where('program_slug', $slug)->countAllResults() > 0) {
                $uniqueNum = rand(1, 999);
                $slug = $slug . '-' . $uniqueNum;
            }
        } else {
            $slug = $slugLama; // Tetap pakai slug lama
        }

        // Jika tidak ada file yang diunggah
        if ($fileFoto->getError() == UPLOAD_ERR_NO_FILE) {
            $namaFotoUpload = $fotoAwal; // Gunakan foto lama
        } else {
            // Hapus foto lama jika bukan foto default dan bukan sama dengan foto baru
            if ($fotoAwal != 'default-program.png' && $fotoAwal != $fileFoto->getName()) {
                $pathToFotoAwal = 'assets/backend/images/programs/' . $fotoAwal;
                if (file_exists($pathToFotoAwal) && is_file($pathToFotoAwal)) {
                    unlink($pathToFotoAwal); // Hapus hanya jika itu adalah file, bukan direktori
                }
            }

            // Simpan gambar baru
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/programs/', $namaFotoUpload);
        }

        // $postViews = $postAwal['post_views']; // Ambil jumlah views sebelumnya

        // Simpan ke database
        $this->programModel->save([
            'program_id' => $program_id,
            'program_title' => $programTitle,
            'program_description' => $description,
            'program_image' => $namaFotoUpload,
            'program_date' => $programDate, // Menyimpan tanggal program
            'category_id' => $category,
            'program_slug' => $slug,
            'program_status' => $programStatus
        ]);
        
        return redirect()->to('/admin/program')->with('msg', 'success');
    }
    
}
