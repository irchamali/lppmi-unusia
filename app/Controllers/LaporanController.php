<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\LaporanModel;
use App\Models\LapModel;

class LaporanController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->laporanModel = new LaporanModel();
        $this->lapModel = new LapModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $this->lapModel->findAll(),
            // 'documents' => $this->docsModel->getAllDocs(),
            'pager' => $this->lapModel->pager,
            'title' => 'Laporan',
            'active' => 'Laporan'
        ];
        return view('laporan_view', $data);
    }
}
