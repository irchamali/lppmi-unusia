<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\SliderModel;

class SliderAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        // $this->load->model('sliderModel');
        $this->sliderModel = new SliderModel();
    }
    public function index()
    {

        $data = [
            'akun' => $this->akun,
            'title' => 'All Slider',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'sliders' => $this->sliderModel->findAll()
        ];

        return view('admin/v_slider', $data);
    }
    public function insert()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'subtitle' => [
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
            return redirect()->to('/admin/slider')->with('msg', 'error');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/slider/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'user_blank.png';
        }
        $title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
        $subtitle = strip_tags(htmlspecialchars($this->request->getPost('subtitle'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        // Simpan ke database
        $this->sliderModel->save([
            'slider_title' => $title,
            'slider_subtitle' => $subtitle,
            'slider_link' => $link,
            'slider_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/slider')->with('msg', 'success');
    }
    public function update()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'subtitle' => [
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
            return redirect()->to('/admin/slider')->with('msg', 'error');
        }
        $slider_id = strip_tags(htmlspecialchars($this->request->getPost('slider_id'), ENT_QUOTES));
        $title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
        $subtitle = strip_tags(htmlspecialchars($this->request->getPost('subtitle'), ENT_QUOTES));
        $link = strip_tags(htmlspecialchars($this->request->getPost('link'), ENT_QUOTES));
        // Cek Foto
        $slider = $this->sliderModel->find($slider_id);
        $fotoAwal = $slider['slider_image'];
        $fileFoto = $this->request->getFile('filefoto');
        if ($fileFoto->getName() == '') {
            $namaFotoUpload = $fotoAwal;
        } else {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/slider/', $namaFotoUpload);
        }
        // Simpan ke database
        $this->sliderModel->update($slider_id, [
            'slider_title' => $title,
            'slider_subtitle' => $subtitle,
            'slider_link' => $link,
            'slider_image' => $namaFotoUpload
        ]);
        return redirect()->to('/admin/slider')->with('msg', 'info');
    }
    public function delete()
    {
        $slider_id = $this->request->getPost('kode');
        $this->sliderModel->delete($slider_id);
        return redirect()->to('/admin/slider')->with('msg', 'success-delete');
    }
}
