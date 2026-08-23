<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'tbl_category';
    protected $primaryKey       = 'category_id';
    protected $allowedFields    = ['category_name', 'category_slug'];

    public function get_post_by_category($slug)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_category.*, tbl_user.user_name, tbl_user.user_photo')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->where('tbl_category.category_slug', $slug)
            ->orderBy('tbl_post.post_date', 'DESC')
            ->get();
    }
    
}
