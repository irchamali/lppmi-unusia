<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tbl_tags';
    protected $primaryKey       = 'tag_id';
    protected $allowedFields    = ['tag_name'];

    public function get_post_by_tags($tag)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_user.user_name, tbl_user.user_photo')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->like('tbl_post.post_tags', $tag)
            ->orderBy('tbl_post.post_date', 'DESC')
            ->get();
    }
}
