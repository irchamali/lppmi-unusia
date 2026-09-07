<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\DocumentModel;
use App\Models\DocumentCategoryModel;
use App\Models\DocumentTypeModel;
use App\Models\DocumentScopeModel;
use App\Models\DocumentRelationModel;
use App\Models\ProdiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DocumentController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->documentModel = new DocumentModel();
        $this->categoryModel = new DocumentCategoryModel();
        $this->typeModel = new DocumentTypeModel();
        $this->scopeModel = new DocumentScopeModel();
        $this->relationModel = new DocumentRelationModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $filters = $this->readFilters();

        $documents = $this->documentModel->getPublicDocuments($filters);

        foreach ($documents as &$document) {
            $document['docs_slug'] = $this->createDocumentSlug($document);
        }
        unset($document);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $documents,
            'categories' => $this->categoryModel->where('category_status', 1)->orderBy('category_name', 'ASC')->findAll(),
            'types' => $this->typeModel->where('type_status', 1)->orderBy('type_name', 'ASC')->findAll(),
            'scopes' => $this->scopeModel->where('scope_status', 1)->orderBy('scope_name', 'ASC')->findAll(),
            'years' => $this->documentModel->getPublicDocumentYears(),
            'fakultasList' => $this->getFakultasOptions(),
            'prodiList' => $this->getProdiOptions(),
            'filters' => $filters,
            'title' => 'Documents',
            'active' => 'Documents'
        ];
        return view('documents/document_view', $data);
    }

    public function detail($slug)
    {
        $slug = trim((string) $slug);
        $documentId = $this->extractDocumentId($slug);

        if ($documentId === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $document = $this->documentModel->findPublicDocument($documentId);

        if ($document === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $document['docs_slug'] = $this->createDocumentSlug($document);
        $relatedDocuments = $this->relationModel->getPublicRelatedDocuments($documentId);

        foreach ($relatedDocuments as &$items) {
            foreach ($items as &$item) {
                $item['docs_slug'] = $this->createDocumentSlug($item);
            }
            unset($item);
        }
        unset($items);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'document' => $document,
            'related_documents' => $relatedDocuments,
            'preview_link' => $this->buildPreviewLink($document['document_file']),
            'download_link' => $this->buildDownloadLink($document['document_file']),
            'title' => 'Document Detail',
            'active' => 'Documents',
        ];

        return view('documents/document_detail', $data);
    }

    private function readFilters(): array
    {
        return [
            'category' => trim((string) ($this->request->getGet('category') ?? '')) ?: null,
            'type' => trim((string) ($this->request->getGet('type') ?? '')) ?: null,
            'scope' => trim((string) ($this->request->getGet('scope') ?? '')) ?: null,
            'year' => trim((string) ($this->request->getGet('year') ?? '')) ?: null,
            'fakultas' => trim((string) ($this->request->getGet('fakultas') ?? '')) ?: null,
            'prodi' => trim((string) ($this->request->getGet('prodi') ?? '')) ?: null,
        ];
    }

    private function getFakultasOptions(): array
    {
        return $this->prodiModel->db->table('tbl_fakultas')->orderBy('fak_name', 'ASC')->get()->getResultArray();
    }

    private function getProdiOptions(): array
    {
        return $this->prodiModel->db->table('tbl_prodi')
            ->select('tbl_prodi.prodi_id, tbl_prodi.prodi_nama, tbl_prodi.prodi_slug, tbl_prodi.fak_id, tbl_fakultas.fak_slug')
            ->join('tbl_fakultas', 'tbl_fakultas.fak_id = tbl_prodi.fak_id', 'left')
            ->orderBy('tbl_prodi.prodi_nama', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function extractDocumentId(string $slug): ?int
    {
        if (preg_match('/-(\d+)$/', $slug, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }

    /**
     * Slug berisi cuplikan judul+tahun agar mudah dibaca, diakhiri id dokumen agar pencarian efisien & stabil.
     */
    private function createDocumentSlug(array $document): string
    {
        $year = !empty($document['document_date']) ? date('Y', strtotime((string) $document['document_date'])) : '';
        $name = trim((string) ($document['document_title'] ?? ''));
        $shortName = $this->shortenName($name, 6);
        $slugSource = trim($year . ' ' . $shortName);

        if ($slugSource === '') {
            $slugSource = 'dokumen';
        }

        return $this->slugify($slugSource) . '-' . (int) $document['document_id'];
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
