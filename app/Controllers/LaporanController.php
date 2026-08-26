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
        $reports = $this->lapModel->getAllLap();

        foreach ($reports as &$report) {
            $report['report_slug'] = $this->createReportSlug($report);
        }
        unset($report);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $reports,
            'pager' => $this->lapModel->pager,
            'title' => 'Laporan',
            'active' => 'Laporan'
        ];
        return view('reports/report_view', $data);
    }

    public function show($slug)
    {
        $slug = trim((string) $slug);

        if ($slug === '') {
            return redirect()->to('/reports');
        }

        $categoryReports = $this->laporanModel->getLap_by_category($slug)->getResultArray();
        if ($categoryReports !== []) {
            foreach ($categoryReports as &$report) {
                $report['report_slug'] = $this->createReportSlug($report);
            }
            unset($report);

            return view('reports/report_category', [
                'site' => $this->siteModel->find(1),
                'home' => $this->homeModel->find(1),
                'about' => $this->aboutModel->find(1),
                'title' => 'Reports',
                'url' => 'reports',
                'keyword' => 'Laporan: ' . $slug,
                'documents' => $categoryReports,
                'active' => 'Reports',
            ]);
        }

        $report = $this->findReportBySlug($slug);
        if ($report !== null) {
            return $this->renderDetail($report);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function detail($slug)
    {
        $slug = trim((string) $slug);
        $report = $this->findReportBySlug($slug);

        if ($report === null) {
            return redirect()->to('/reports/' . $slug);
        }

        return $this->renderDetail($report);
    }

    private function renderDetail(array $report)
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'report' => $report,
            'preview_link' => $this->buildPreviewLink($report['lap_link']),
            'download_link' => $this->buildDownloadLink($report['lap_link']),
            'title' => 'Detail Laporan',
            'active' => 'Laporan',
        ];

        return view('reposrts/report_detail', $data);
    }

    private function findReportBySlug(string $slug): ?array
    {
        $reports = $this->lapModel->getAllLap();

        foreach ($reports as $report) {
            if ($this->createReportSlug($report) === $slug) {
                $report['report_slug'] = $slug;
                return $report;
            }
        }

        return null;
    }

    private function createReportSlug(array $report): string
    {
        $year = trim((string) ($report['lap_year'] ?? ''));
        $name = trim((string) ($report['lap_name'] ?? ''));
        $slugSource = trim($year . ' ' . $name);

        if ($slugSource === '') {
            $slugSource = (string) ($report['lap_id'] ?? 'report');
        }

        return $this->slugify($slugSource);
    }

    private function slugify(string $value): string
    {
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]+/i', '-', $value) ?? '';
        $value = trim($value, '-');

        return $value !== '' ? $value : 'report';
    }

    private function buildPreviewLink(string $link): string
    {
        $link = trim($link);
        $fileId = $this->extractGoogleDriveFileId($link);

        if ($fileId !== null) {
            return 'https://drive.google.com/file/d/' . $fileId . '/preview';
        }

        if (preg_match('~^https?://docs\.google\.com/(document|spreadsheets|presentation)/d/([^/]+)~i', $link, $matches)) {
            return 'https://docs.google.com/' . $matches[1] . '/d/' . $matches[2] . '/preview';
        }

        return $link;
    }

    private function buildDownloadLink(string $link): string
    {
        $link = trim($link);
        $fileId = $this->extractGoogleDriveFileId($link);

        if ($fileId !== null) {
            return 'https://drive.google.com/uc?export=download&id=' . $fileId;
        }

        if (preg_match('~^https?://docs\.google\.com/document/d/([^/]+)~i', $link, $matches)) {
            return 'https://docs.google.com/document/d/' . $matches[1] . '/export?format=pdf';
        }

        if (preg_match('~^https?://docs\.google\.com/spreadsheets/d/([^/]+)~i', $link, $matches)) {
            return 'https://docs.google.com/spreadsheets/d/' . $matches[1] . '/export?format=pdf';
        }

        if (preg_match('~^https?://docs\.google\.com/presentation/d/([^/]+)~i', $link, $matches)) {
            return 'https://docs.google.com/presentation/d/' . $matches[1] . '/export/pdf';
        }

        return $link;
    }

    private function extractGoogleDriveFileId(string $link): ?string
    {
        if (preg_match('~drive\.google\.com/file/d/([^/\?]+)~i', $link, $matches)) {
            return $matches[1];
        }

        if (preg_match('~drive\.google\.com/open\?id=([^&]+)~i', $link, $matches)) {
            return $matches[1];
        }

        if (preg_match('~drive\.google\.com/uc\?(?:[^#]*&)?id=([^&]+)~i', $link, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
