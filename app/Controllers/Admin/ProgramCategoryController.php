<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\InboxModel;
use App\Models\CommentModel;
use App\Models\ProgramAdminModel;
use App\Models\ProgramCategoryModel;

class ProgramCategoryController extends BaseController
{
    protected $siteModel;
    protected $inboxModel;
    protected $commentModel;
    protected $programModel;
    protected $categoryModel;
    protected $akun;
    protected $active;

    public function __construct()
    {
        $this->siteModel = new SiteModel();
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->programModel = new ProgramAdminModel();
        $this->categoryModel = new ProgramCategoryModel();
        
        $this->akun = session()->get('akun');
        $this->active = 'procat';
    }

    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Program Categories',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->countAllResults(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->countAllResults(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('admin/v_program_categories', $data);
    }

    public function save()
    {
        $category = trim($this->request->getPost('category'));
        if (empty($category)) {
            return redirect()->back()->with('msg', 'error')->withInput();
        }
        
        // Sanitasi input
        $category = strip_tags(htmlspecialchars($category, ENT_QUOTES));
        $slug = strtolower(str_replace(" ", "-", preg_replace('/[^a-zA-Z0-9 ]/', '', $category)));
        
        $this->categoryModel->insert([
            'category_name' => $category,
            'category_slug' => $slug
        ]);

        return redirect()->to('admin/procat')->with('msg', 'success');
    }

    public function edit()
    {
        $id = $this->request->getPost('kode');
        $category = trim($this->request->getPost('category2'));
        if (empty($category) || empty($id)) {
            return redirect()->back()->with('msg', 'error')->withInput();
        }
        
        $category = strip_tags(htmlspecialchars($category, ENT_QUOTES));
        $slug = strtolower(str_replace(" ", "-", preg_replace('/[^a-zA-Z0-9 ]/', '', $category)));
        
        $this->categoryModel->update($id, [
            'category_name' => $category,
            'category_slug' => $slug
        ]);
        
        return redirect()->to('admin/procat')->with('msg', 'info');
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->categoryModel->delete($id);

        return redirect()->to('admin/procat')->with('msg', 'success-delete');
    }

    // public function delete()
    // {
    //     $id = $this->request->getPost('id');
    //     if (empty($id)) {
    //         return redirect()->back()->with('msg', 'error');
    //     }
        
    //     $this->categoryModel->delete($id);

    //     return redirect()->to('admin/procat')->with('msg', 'deleted');
    // }

    // public function delete()
    // {
    //     $id = $this->request->getVar('id'); // Bisa menangani DELETE request
    //     if (empty($id)) {
    //         return redirect()->back()->with('msg', 'error');
    //     }
        
    //     $this->categoryModel->delete($id);

    //     return redirect()->to('admin/procat')->with('msg', 'deleted');
    // }

}
