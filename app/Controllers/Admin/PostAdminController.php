<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PostModel;
use App\Models\TagModel;
use App\Models\SiteModel;

class PostAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();

        // Tambahkan variabel ini jika digunakan
        $this->akun = session()->get('akun');
        $this->active = 'post';
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            // 'posts' => $this->postModel->get_all_post()->getResultArray()
            // 'posts' => $this->postModel->get_all_post() // Hanya panggil satu parameter
            'posts' => $this->postModel->get_all_post(null, true) // Admin melihat semua post
        ];

        return view('admin/v_post', $data);
    }
    // admin post - toggle post status
    public function toggle_status($post_id)
    {
        if ($this->postModel->toggle_post_status($post_id)) {
            return redirect()->to('/admin/post')->with('success', 'Post status updated successfully.');
        }
        return redirect()->to('/admin/post')->with('error', 'Failed to update post status.');
    }

    public function add_new()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Add New Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll()
        ];
        return view('admin/v_add_post', $data);
    }
    public function publish()
    {
        if (!$this->validate([
            'title' => [
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
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('/admin/post/add_new')->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan ada penginputan yang tidak sesuai. silakan coba lagi!');
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
                return redirect()->to('/admin/post/add_new')->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan file gambar tidak valid.');
            }
        }
        
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');

            // Simpan nama file yang akan digunakan
            $namaFotoUpload = $fotoUpload->getRandomName();

            // Kompresi gambar
            $image = \Config\Services::image()
                ->withFile($fotoUpload)
                ->resize(1000, 800, true) // Ubah ukuran sesuai kebutuhan
                ->save('assets/backend/images/post/' . $namaFotoUpload);

            // Hapus file asli jika proses kompresi selesai
            if (file_exists('assets/backend/images/post/' . $fotoUpload->getName())) {
                unlink('assets/backend/images/post/' . $fotoUpload->getName());
            }
        } else {
            $namaFotoUpload = 'default-post.png';
        }

        $title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
        $contents = $this->request->getPost('contents');
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
        $description = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));

        if ($this->postModel->where('post_slug', $slug)->get()->getNumRows() > 0) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }

        $tags[] = $this->request->getPost('tag');
        foreach ($tags as $tag) {
            $tags = implode(",", $tag);
        }

        // Simpan ke database
        $this->postModel->save([
            'post_title' => $title,
            'post_description' => $description,
            'post_contents' => $contents,
            'post_image' => $namaFotoUpload,
            'post_category_id' => $category,
            'post_tags' => $tags,
            'post_slug' => $slug,
            'post_status' => 1,
            'post_views' => 0,
            'post_user_id' => session('id')
        ]);
        return redirect()->to('/admin/post')->with('msg', 'success');
    }
    public function edit($id)
    {
        $post = $this->postModel->find($id);
        $post_tags = explode(',', $post['post_tags']);
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Edit Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll(),
            'post' => $post,
            'tags' => $this->tagModel->findAll(),
            'post_tags' => $post_tags
        ];
        return view('admin/v_edit_post', $data);
    }
    
    public function update()
    {
        $post_id = $this->request->getPost('post_id');
        // Validasi
        if (!$this->validate([
            'title' => [
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
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric' => 'inputan harus angka'
                ]
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to("/admin/post/$post_id/edit")->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan ada penginputan yang tidak sesuai. silakan coba lagi!');
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
                return redirect()->to("/admin/post/$post_id/edit")->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan file gambar tidak valid.');
            }
        }
        // Inisiasi
        $title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
        $contents = $this->request->getPost('contents');
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
        $description = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));

        if ($this->postModel->where('post_slug', $slug)->get()->getNumRows() > 1) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }

        $tags[] = $this->request->getPost('tag');
        foreach ($tags as $tag) {
            $tags = implode(",", $tag);
        }
        
        // Cek foto
        $postAwal = $this->postModel->find($post_id);
        $fotoAwal = $postAwal['post_image'];
        $fileFoto = $this->request->getFile('filefoto');

        // Jika tidak ada file yang diunggah
        if ($fileFoto->getError() == UPLOAD_ERR_NO_FILE) {
            $namaFotoUpload = $fotoAwal; // Gunakan foto lama
        } else {
            // Hapus foto lama jika bukan foto default dan bukan sama dengan foto baru
            if ($fotoAwal != 'default-post.png' && $fotoAwal != $fileFoto->getName()) {
                $pathToFotoAwal = 'assets/backend/images/post/' . $fotoAwal;
                if (file_exists($pathToFotoAwal) && is_file($pathToFotoAwal)) {
                    unlink($pathToFotoAwal); // Hapus hanya jika itu adalah file, bukan direktori
                }
            }

            // Simpan gambar baru
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/post/', $namaFotoUpload);
        }

        $postViews = $postAwal['post_views']; // Ambil jumlah views sebelumnya

        // Simpan ke database tanpa mengubah views
        $this->postModel->save([
            'post_id' => $post_id,
            'post_title' => $title,
            'post_description' => $description,
            'post_contents' => $contents,
            'post_image' => $namaFotoUpload,
            'post_category_id' => $category,
            'post_tags' => $tags,
            'post_slug' => $slug,
            'post_status' => 1,
            'post_views' => $postViews, // Gunakan nilai views sebelumnya
            'post_user_id' => session('id')
        ]);
        
        return redirect()->to('/admin/post')->with('msg', 'success');
    }
    
    public function delete()
    {
        $post_id = $this->request->getPost('id');
        $this->postModel->delete($post_id);
        return redirect()->to('/admin/post')->with('msg', 'success-delete');
    }
}
