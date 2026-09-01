<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentRelationTypeModel;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\InboxModel;

class DocRelationTypeAdminController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $siteModel;
    protected $docrelationtypeModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->docrelationtypeModel = new DocumentRelationTypeModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Document Relation Type',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'relationtypes' => $this->docrelationtypeModel->findAll()
        ];

        return view('admin/v_docrelationtype', $data);
    }

    public function save(){
        $relation = strip_tags(htmlspecialchars($this->request->getPost('relation'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('description'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $relation);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->docrelationtypeModel->save([
            'relation_name' => $relation,
            'relation_slug' => $slug,
            'relation_description' => $desc
        ]);

        return redirect()->to('admin/docrelationtype')->with('msg', 'success');
    }

    public function edit()
    {
        $id       = $this->request->getPost('kode');
        $relation = strip_tags(htmlspecialchars($this->request->getPost('relationedit'), ENT_QUOTES));
        $desc = strip_tags(htmlspecialchars($this->request->getPost('descriptionedit'), ENT_QUOTES));
        $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $relation);
        $trim     = trim($string);
        $slug     = strtolower(str_replace(" ", "-", $trim));
        $this->docrelationtypeModel->save([
            'relation_type_id' => $id,
            'relation_name' => $relation,
            'relation_slug' => $slug,
            'relation_description' => $desc
        ]);
        return redirect()->to('admin/docrelationtype')->with('msg', 'info');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->docrelationtypeModel->delete($id);

        return redirect()->to('admin/docrelationtype')->with('msg', 'success-delete');
    }

}
