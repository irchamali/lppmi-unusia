<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\ApsModel;
use App\Models\AkreditasiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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
            'documents' => $this->akreditasiModel->getAllAps(),
            'pager' => $this->akreditasiModel->pager,
            'title' => 'Akreditasi',
            'active' => 'Akreditasi'
        ];

        return view('akreditasi_view', $data);
    }

    public function detail($slug)
    {
        $slug = trim((string) $slug);

        if ($slug === '') {
            return redirect()->to('/akreditasi');
        }

        $program = $this->akreditasiModel->getGroupedHistoryByProdi($slug);

        if ($program === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'program' => $program,
            'latest' => $program['latest'] ?? null,
            'history' => $program['previous_history'] ?? [],
            'title' => 'Detail Akreditasi',
            'active' => 'Akreditasi'
        ];

        return view('akreditasi_detail', $data);
    }
}
