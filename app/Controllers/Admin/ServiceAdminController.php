<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\ServiceAdminModel;

class ServiceAdminController extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->serviceModel = new ServiceAdminModel();

        $this->akun = session()->get('akun');
        $this->active = 'service';
    }
    
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'All Service',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            
            'services' => $this->serviceModel->getAllServices()
        ];

        return view('admin/v_services', $data);
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
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'inputan harus berupa alphaber dan strip'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'desc2' => [
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
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/service')->with('msg', 'error');
        }

        // Cek apakah ada file gambar yang diunggah
        if ($this->request->getFile('filefoto')->isValid()) {
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();

            // Simpan dan kompres gambar
            \Config\Services::image()
                ->withFile($fotoUpload)
                ->resize(800, 346, true)
                ->save('assets/backend/images/services/' . $namaFotoUpload);
        } else {
            $namaFotoUpload = 'default-services.png';
        }

        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        $desc2 = strip_tags(htmlspecialchars($this->request->getPost('desc2'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));

        if ($this->serviceModel->where('service_slug', $slug)->get()->getNumRows() > 0) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }
        
        // Simpan ke database
        $this->serviceModel->save([
            'service_name' => $nama,
            'service_slug' => $slug,
            'service_desc' => $desc,
            'service_desc2' => $desc2,
            'service_link' => $link,
            'service_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/service')->with('msg', 'success');
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
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'inputan harus berupa alphaber dan strip'
                ]
            ],
            'desc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'desc2' => [
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
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/service')->with('msg', 'error');
        }

        $service_id = strip_tags(htmlspecialchars($this->request->getPost('service_id'), ENT_QUOTES));
        $nama = strip_tags(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('desc'), ENT_QUOTES));
        $desc2 = strip_tags(htmlspecialchars($this->request->getPost('desc2'), ENT_QUOTES));
        $slug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
        if ($this->serviceModel->where('service_slug', $slug)->get()->getNumRows() > 1) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }

        // Cek Foto
        $service = $this->serviceModel->find($service_id);
        $fotoAwal = $service['service_image'];
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/services/', $namaFotoUpload);
        }
        // Simpan ke database
        $this->serviceModel->update($service_id, [
            'service_name' => $nama,
            'service_slug' => $slug,
            'service_desc' => $desc,
            'service_desc2' => $desc2,
            'service_link' => $link,
            'service_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/service')->with('msg', 'info');
    }

    public function delete()
    {
        $service_id = $this->request->getPost('kode');
        $this->serviceModel->delete($service_id);
        return redirect()->to('/admin/service')->with('msg', 'success-delete');
    }
    
}
