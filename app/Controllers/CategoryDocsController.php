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
use App\Models\ProdiModel;

class CategoryDocsController extends BaseController
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
        $this->prodiModel = new ProdiModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/documents');
        }

        $category = $this->categoryModel->where('category_slug', $slug)->first();
        $filters = [
            'category' => $slug,
            'type' => trim((string) ($this->request->getGet('type') ?? '')) ?: null,
            'scope' => trim((string) ($this->request->getGet('scope') ?? '')) ?: null,
            'year' => trim((string) ($this->request->getGet('year') ?? '')) ?: null,
            'fakultas' => trim((string) ($this->request->getGet('fakultas') ?? '')) ?: null,
            'prodi' => trim((string) ($this->request->getGet('prodi') ?? '')) ?: null,
        ];

        $documents = $category !== null ? $this->documentModel->getPublicDocuments($filters) : [];
        $keyword = $category !== null ? 'Dokumen kategori: ' . $category['category_name'] : "Kategori '$slug' tidak ditemukan";

        foreach ($documents as &$document) {
            $document['docs_slug'] = $this->createDocumentSlug($document);
        }
        unset($document);

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'documents' => $documents,
            'category' => $category,
            'categories' => $this->categoryModel->where('category_status', 1)->orderBy('category_name', 'ASC')->findAll(),
            'types' => $this->typeModel->where('type_status', 1)->orderBy('type_name', 'ASC')->findAll(),
            'scopes' => $this->scopeModel->where('scope_status', 1)->orderBy('scope_name', 'ASC')->findAll(),
            'years' => $this->documentModel->getPublicDocumentYears(),
            'fakultasList' => $this->prodiModel->db->table('tbl_fakultas')->orderBy('fak_name', 'ASC')->get()->getResultArray(),
            'prodiList' => $this->prodiModel->db->table('tbl_prodi')
                ->select('tbl_prodi.prodi_id, tbl_prodi.prodi_nama, tbl_prodi.prodi_slug, tbl_prodi.fak_id, tbl_fakultas.fak_slug')
                ->join('tbl_fakultas', 'tbl_fakultas.fak_id = tbl_prodi.fak_id', 'left')
                ->orderBy('tbl_prodi.prodi_nama', 'ASC')
                ->get()
                ->getResultArray(),
            'filters' => $filters,
            'hideCategoryFilter' => true,
            'formAction' => base_url('documents/' . $slug),
            'title' => 'Document',
            'url' => 'd',
            'keyword' => $keyword,
            'active' => 'Document'
        ];
        return view('documents/document_category', $data);
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
}

