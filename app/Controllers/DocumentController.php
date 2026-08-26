<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\DocumentModel;
use App\Models\DocsModel;

class DocumentController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->documentModel = new DocumentModel();
        $this->docsModel = new DocsModel();
    }
    public function index()
    {
        $documents = $this->docsModel->getAllDocs();

        foreach ($documents as &$document) {
            $document['docs_slug'] = $this->createDocumentSlug($document);
        }
        unset($document);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $documents,
            'pager' => $this->docsModel->pager,
            'title' => 'Documents',
            'active' => 'Documents'
        ];
        return view('documents/document_view', $data);
    }

    public function detail($slug)
    {
        $slug = trim((string) $slug);
        $document = $this->findDocumentBySlug($slug);

        if ($document === null) {
            return redirect()->to('/documents/' . $slug);
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'document' => $document,
            'preview_link' => $this->buildPreviewLink($document['docs_link']),
            'download_link' => $this->buildDownloadLink($document['docs_link']),
            'title' => 'Document Detail',
            'active' => 'Documents',
        ];

        return view('documents/document_detail', $data);
    }

    private function findDocumentBySlug(string $slug): ?array
    {
        $documents = $this->docsModel->getAllDocs();

        foreach ($documents as $document) {
            if ($this->createDocumentSlug($document) === $slug) {
                $document['docs_slug'] = $slug;
                return $document;
            }
        }

        return null;
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
