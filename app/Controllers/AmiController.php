<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\ProdiModel;

class AmiController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->prodiModel = new ProdiModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'daftils' => $this->prodiModel->findAll(),
            'title' => 'Daftar Tilik AMI',
            'active' => 'Daftar Tilik AMI'
        ];
        return view('formulir/ami_view', $data);
    }
}
