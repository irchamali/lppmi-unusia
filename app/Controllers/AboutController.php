<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
// use App\Models\DocumentModel;
// use App\Models\DocsModel;

class AboutController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        // $this->documentModel = new DocumentModel();
        // $this->docsModel = new DocsModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            
            'title' => 'About',
            'active' => 'About'
        ];
        return view('about_view', $data);
    }
}
