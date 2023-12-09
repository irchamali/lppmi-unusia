<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LapCategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class LapCategoryAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->lapcategoryModel = new LapCategoryModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Kategori Laporan',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->lapcategoryModel->findAll()
        ];

        return view('admin/v_lapcategory', $data);
    }

    public function save(){
        $category = strip_tags(htmlspecialchars($this->request->getPost('category'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->lapcategoryModel->save([
            'lapcategory_name' => $category,
            'lapcategory_slug' => $slug
        ]);

        return redirect()->to('admin/lapcategory')->with('msg', 'success');
    }
    
    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $category = strip_tags(htmlspecialchars($this->request->getPost('categoryedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->lapcategoryModel->save([
            'lapcategory_id' => $id,
            'lapcategory_name' => $category,
            'lapcategory_slug' => $slug
        ]);
        return redirect()->to('admin/lapcategory')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->lapcategoryModel->delete($id);

        return redirect()->to('admin/lapcategory')->with('msg', 'success-delete');
    }

}
