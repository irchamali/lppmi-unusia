<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\TagModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;

class TagController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->tagModel = new TagModel();
        $this->categoryModel = new CategoryModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/post');
        }
        $posts = $this->tagModel->get_post_by_tags($slug);
        if ($posts->getNumRows() < 1) {
            $posts = $posts->getResultArray();
            $keyword = "Tag '$slug' tidak ditemukan";
        } else {
            $posts = $posts->getResultArray();
            $keyword = "Tag: $slug ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'posts' => $this->tagModel->findAll(),
            // 'posts' => $this->tagModel->get_post_by_tags($tag),
            'posts' => $this->tagModel->paginate(2, 'posts'),
            'pager' => $this->tagModel->pager,
            'title' => 'Tag',
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_tag', $data);
    }
}
