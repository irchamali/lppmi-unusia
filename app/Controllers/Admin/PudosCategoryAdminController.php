<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\PudosCategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class PudosCategoryAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $publikasiModel;
    protected $pudoscategoryModel;
    protected $active; // Tambahkan properti ini

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->pudoscategoryModel = new PudosCategoryModel();
        $this->active = 'publikasi'; // Atur nilai default atau sesuai kebutuhan Anda
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Kategori Publikasi',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->pudoscategoryModel->findAll()
        ];

        return view('admin/v_pudoscategory', $data);
    }

    public function save(){
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->pudoscategoryModel->save([
            'pudoscategory_name' => $category,
            'pudoscategory_slug' => $slug
        ]);

        return redirect()->to('admin/pudoscategory')->with('msg', 'success');
    }
    
    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $category = strip_tags(htmlspecialchars($this->request->getPost('categoryedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->pudoscategoryModel->save([
            'pudoscategory_id' => $id,
            'pudoscategory_name' => $category,
            'pudoscategory_slug' => $slug
        ]);
        return redirect()->to('admin/pudoscategory')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->pudoscategoryModel->delete($id);

        return redirect()->to('admin/pudoscategory')->with('msg', 'success-delete');
    }

}
