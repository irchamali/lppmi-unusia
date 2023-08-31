<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\LapModel;
use App\Models\LapCategoryModel;
use App\Models\SiteModel;

class CategoryLapController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->lapModel = new LapModel();
        $this->lapcategoryModel = new LapcategoryModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/laporan');
        }
        $documents = $this->lapcategoryModel->getLap_by_category($slug);
        if ($documents->getNumRows() < 1) {
            $documents = $documents->getResultArray();
            $keyword = "Laporan '$slug' tidak ditemukan";
        } else {
            $documents = $documents->getResultArray();
            $keyword = "Laporan: $slug ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $this->lapcategoryModel->getLap_by_category($slug),
            'title' => 'Laporan',
            'url' => 'laporan',
            'keyword' => $keyword,
            'documents' => $documents,
            'active' => 'Laporan'
        ];
        return view('laporan_category', $data);
    }
}
