<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\PostviewModel;
use App\Models\SiteModel;
use App\Models\TagModel;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postviewModel = new PostviewModel();
        $this->tagModel = new TagModel();
    }
    public function index($slug = null)
    {
        if ($slug == null) {
            $data = [
                'site' => $this->siteModel->find(1),
                'home' => $this->homeModel->find(1),
                'about' => $this->aboutModel->find(1),
                // 'posts' => $this->postviewModel->findAll(),
                'posts' => $this->postviewModel->getAllPosts(),
                // 'posts' => $this->postviewModel->paginate(3, 'posts'),
                'pager' => $this->postviewModel->pager,
                'title' => 'Rilis Berita',
                'active' => 'Post'
            ];
            return view('post_view', $data);
        }
        $postQuery = $this->postviewModel->get_post_by_slug($slug);
        $post = $postQuery->getRowArray();

        if (!$post) {
            return redirect()->to('/posts');
        }

        $post_tags = explode(',', (string) ($post['post_tags'] ?? ''));
        $post_id = $post['post_id'];
        $category_id = $post['category_id'];
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $cek_ip = $this->postviewModel->db->table('tbl_post_views')
            ->where('view_ip', $user_ip)
            ->where('view_post_id', $post_id)
            ->where('DATE(view_date)=CURDATE()', null, false)
            ->countAllResults();
        if ($cek_ip < 1) {
            $this->postviewModel->count_views($user_ip, $post_id);
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'post' => $post,
            'post_tags' => $post_tags,
            'related_post' => $this->postviewModel->get_related_post($category_id, $post_id)->getResultArray(),
            'tags' => $this->tagModel->findAll(),
            'title' => $post['post_title'] ?? 'Post',
            'active' => 'Post'
        ];
        return view('post_detail', $data);
    }
    public function search()
    {
        $query = $this->request->getGet('search_query');
        if (!$query) {
            return redirect()->to('/posts');
        }
        $posts = $this->postviewModel->getPostsBySearchPaginated($query);
        if (count($posts) < 1) {
            $keyword = "Keyword '$query' tidak ditemukan";
        } else {
            $keyword = "Keyword: $query ";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Search',
            'keyword' => $keyword,
            'posts' => $posts,
            'pager' => $this->postviewModel->pager,
            'active' => 'Post'
        ];
        return view('post_search', $data);
    }
    public function tag($tag)
    {
        $posts = $this->postviewModel->getPostsByTagPaginated($tag);
        if (count($posts) < 1) {
            $keyword = "Tag $tag tidak ditemukan";
        } else {
            $keyword = "Tag: $tag";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => 'Tags',
            'keyword' => $keyword,
            'posts' => $posts,
            'pager' => $this->postviewModel->pager,
            'active' => 'Post'
        ];
        return view('post_tag', $data);
    }
    public function author($user_id)
    {
        $posts = $this->postviewModel->where('post_user_id', $user_id)->get();
        if ($posts->getNumRows() < 1) {
            $posts = $posts->getResultArray();
            $keyword = "Postingan Author tidak ditemukan";
        } else {
            $posts = $posts->getResultArray();
            $keyword = "Author: $user_id";
        }
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'title' => "Author $user_id",
            'keyword' => $keyword,
            'posts' => $posts,
            'active' => 'Post'
        ];
        return view('post_author', $data);
    }
}
