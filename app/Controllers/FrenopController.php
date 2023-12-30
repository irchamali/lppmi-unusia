<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\ProdiModel;

class FrenopController extends BaseController
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
            'title' => 'Rencana Operasional',
            'active' => 'Rencana Operasional'
        ];
        return view('formulir/renop_view', $data);
    }
}
