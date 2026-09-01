<?php

namespace App\Controllers\Manager;

use App\Controllers\Admin\DocsAdminController;

class DocumentManagerController extends DocsAdminController
{
	public function index()
	{
		return view('admin/v_document', [
			'site' => $this->siteModel->find(1),
			'akun' => $this->akun,
			'title' => 'All Document',
			'active' => 'document',
			'total_inbox' => 0,
			'inboxs' => [],
			'total_comment' => 0,
			'comments' => [],
			'helper_text' => helper('text'),
			'breadcrumbs' => $this->request->getUri()->getSegments(),
			'categories' => $this->docscategoryModel->findAll(),
			'scopes' => $this->scopeModel->findAll(),
			'types' => $this->typeModel->findAll(),
			'fakultas' => $this->prodiModel->db->table('tbl_fakultas')->orderBy('fak_name', 'ASC')->get()->getResultArray(),
			'prodi' => $this->prodiModel->orderBy('prodi_nama', 'ASC')->findAll(),
			'documents' => $this->documentModel->getDocumentsByUser((int) session('id')),
		]);
	}
	public function dashboard()
	{
		$documents = $this->documentModel->getDocumentsByUser((int) session('id'));

		return view('admin/v_document_dashboard', [
			'site' => $this->siteModel->find(1),
			'akun' => $this->akun,
			'title' => 'Manager Dashboard',
			'active' => 'dashboard',
			'total_inbox' => 0,
			'inboxs' => [],
			'total_comment' => 0,
			'comments' => [],
			'helper_text' => helper('text'),
			'breadcrumbs' => $this->request->getUri()->getSegments(),
			'dashboard' => $this->documentModel->summarizeDocuments($documents),
			'documentUrl' => '/manager/document',
		]);
	}
}