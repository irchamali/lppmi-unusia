<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'tbl_category';
    protected $primaryKey       = 'category_id';
    protected $allowedFields    = ['category_name', 'category_slug'];

    public function get_post_by_category($slug, $limit = 9)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_category.category_name, tbl_category.category_slug, tbl_user.user_name, tbl_user.user_photo')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->where('tbl_category.category_slug', $slug)
            ->where('tbl_post.post_status', 1)
            ->orderBy('tbl_post.post_date', 'DESC')
            ->get($limit)
            ->getResultArray();
    }
    
    public function getAllCategoriesWithPosts()
    {
        return $this->db->table('tbl_category c')
            ->select('c.category_id, c.category_name, c.category_slug, COUNT(p.post_id) AS total_posts')
            ->join('tbl_post p', 'p.post_category_id = c.category_id', 'left')
            ->groupBy('c.category_id')
            ->orderBy('total_posts', 'DESC')
            ->get()
            ->getResultArray();
    }
    
}
