<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentScopeModel;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class DocScopeAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $siteModel;
    protected $docscopeModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->docscopeModel = new DocumentScopeModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Scope',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'scopes' => $this->docscopeModel->findAll()
        ];

        return view('admin/v_docscope', $data);
    }

    public function save(){
        $scope = strip_tags(htmlspecialchars($this->request->getPost('scope'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $scope);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->docscopeModel->save([
            'scope_name' => $scope,
            'scope_slug' => $slug,
            'scope_description' => $desc
        ]);

        return redirect()->to('admin/docscope')->with('msg', 'success');
    }

    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $scope = strip_tags(htmlspecialchars($this->request->getPost('scopeedit'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('descriptionedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $scope);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->docscopeModel->save([
            'scope_id' => $id,
            'scope_name' => $scope,
            'scope_slug' => $slug,
            'scope_description' => $desc
        ]);
        return redirect()->to('admin/docscope')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->docscopeModel->delete($id);

        return redirect()->to('admin/docscope')->with('msg', 'success-delete');
    }

}
