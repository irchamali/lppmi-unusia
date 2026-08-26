<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = ['user_name'];

    public function get_post_by_authors($author)
    {
        $query = $this->db->query("
            SELECT tbl_post.*, 
                tbl_user.user_name, 
                tbl_user.user_photo, 
                tbl_category.*
            FROM tbl_post
            LEFT JOIN tbl_user ON tbl_post.post_user_id = tbl_user.user_id
            LEFT JOIN tbl_category ON tbl_post.post_category_id = tbl_category.category_id
            WHERE tbl_user.user_name LIKE '%$author%'
            GROUP BY tbl_post.post_id
            ORDER BY tbl_post.post_date DESC
        ");
        return $query;
    }

}
