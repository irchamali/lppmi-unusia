<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\ApsModel;
use App\Models\AkreditasiModel;

class AkreditasiController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->apsModel = new ApsModel();
        $this->akreditasiModel = new AkreditasiModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $this->akreditasiModel->findAll(),
            // 'documents' => $this->docsModel->getAllDocs(),
            'pager' => $this->akreditasiModel->pager,
            'title' => 'Akreditasi',
            'active' => 'Akreditasi'
        ];
        return view('akreditasi_view', $data);
    }
}
