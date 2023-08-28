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

            'categories' => $this->prodiModel->findAll()
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
