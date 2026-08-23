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
            return redirect()->to('/r');
        }
        $documents = $this->lapcategoryModel->getLap_by_category($slug);
        if ($documents->getNumRows() < 1) {
            $documents = $documents->getResultArray();
            $keyword = "Laporan '$slug' tidak ditemukan";
        } else {
            $documents = $documents->getResultArray();
            $keyword = "Laporan: $slug ";
        }

        foreach ($documents as &$document) {
            $document['report_slug'] = $this->createReportSlug($document);
        }
        unset($document);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $this->lapcategoryModel->getLap_by_category($slug),
            'title' => 'Report',
            'url' => 'r',
            'keyword' => $keyword,
            'documents' => $documents,
            'active' => 'Report'
        ];
        return view('report_category', $data);
    }

    private function createReportSlug(array $report): string
    {
        $year = trim((string) ($report['lap_year'] ?? ''));
        $name = trim((string) ($report['lap_name'] ?? ''));
        $words = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);
        $shortName = ($words === false || $words === []) ? '' : implode(' ', array_slice($words, 0, 6));
        $slugSource = trim($year . ' ' . $shortName);

        if ($slugSource === '') {
            $slugSource = (string) ($report['lap_id'] ?? 'report');
        }

        $slug = strtolower($slugSource);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug) ?? '';

        return trim($slug, '-') !== '' ? trim($slug, '-') : 'report';
    }
}
