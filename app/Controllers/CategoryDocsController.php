<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\DocsModel;
use App\Models\DocsCategoryModel;
use App\Models\SiteModel;

class CategoryDocsController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->docsModel = new DocsModel();
        $this->docscategoryModel = new DocscategoryModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/d');
        }
        $documents = $this->docscategoryModel->getDocs_by_category($slug);
        if ($documents->getNumRows() < 1) {
            $documents = $documents->getResultArray();
            $keyword = "Dokumen '$slug' tidak ditemukan";
        } else {
            $documents = $documents->getResultArray();
            $keyword = "Dokumen: $slug ";
        }

        foreach ($documents as &$document) {
            $document['docs_slug'] = $this->createDocumentSlug($document);
        }
        unset($document);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $this->docscategoryModel->getDocs_by_category($slug),
            'title' => 'Document',
            'url' => 'd',
            'keyword' => $keyword,
            'documents' => $documents,
            'active' => 'Document'
        ];
        return view('document_category', $data);
    }

    private function createDocumentSlug(array $document): string
    {
        $year = trim((string) ($document['docs_year'] ?? ''));
        $name = trim((string) ($document['docs_name'] ?? ''));
        $shortName = $this->shortenName($name, 6);
        $slugSource = trim($year . ' ' . $shortName);

        if ($slugSource === '') {
            $slugSource = (string) ($document['docs_id'] ?? 'dokumen');
        }

        return $this->slugify($slugSource);
    }

    private function shortenName(string $name, int $maxWords): string
    {
        $words = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);

        if ($words === false || $words === []) {
            return '';
        }

        return implode(' ', array_slice($words, 0, $maxWords));
    }

    private function slugify(string $value): string
    {
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]+/i', '-', $value) ?? '';
        $value = trim($value, '-');

        return $value !== '' ? $value : 'dokumen';
    }
}
