<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\PostviewModel;
use App\Models\SiteModel;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->postviewModel = new PostviewModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/posts');
        }
        $posts = $this->postviewModel->getPostsByCategoryPaginated($slug);
        if (count($posts) < 1) {
            $keyword = "Category '$slug' tidak ditemukan";
        } else {
            $keyword = "Category: $slug ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'posts' => $posts,
            'pager' => $this->postviewModel->pager,
            'title' => 'Category',
            'keyword' => $keyword,
            'active' => 'Post'
        ];
        return view('posts/post_category', $data);
    }
}
