<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentTypeModel;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class DocTypeAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $siteModel;
    protected $doctypeModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->doctypeModel = new DocumentTypeModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Type',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'types' => $this->doctypeModel->findAll()
        ];

        return view('admin/v_doctype', $data);
    }

    public function save(){
        $type = strip_tags(htmlspecialchars($this->request->getPost('type'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $type);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->doctypeModel->save([
            'type_name' => $type,
            'type_slug' => $slug,
            'type_description' => $desc
        ]);

        return redirect()->to('admin/doctype')->with('msg', 'success');
    }

    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $type = strip_tags(htmlspecialchars($this->request->getPost('typeedit'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('descriptionedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $type);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->doctypeModel->save([
            'type_id' => $id,
            'type_name' => $type,
            'type_slug' => $slug,
            'type_description' => $desc
        ]);
        return redirect()->to('admin/doctype')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->doctypeModel->delete($id);

        return redirect()->to('admin/doctype')->with('msg', 'success-delete');
    }

}
