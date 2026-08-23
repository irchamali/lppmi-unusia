<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'tbl_post';
    protected $primaryKey       = 'post_id';
    protected $allowedFields    = ['post_title', 'post_description', 'post_contents', 'post_image', 'post_category_id', 'post_tags', 'post_slug', 'post_status', 'post_views', 'post_user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'post_date';
    protected $updatedField  = 'post_last_update';

    public function get_post_by_slug($slug)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_user.user_name, tbl_user.user_photo, tbl_category.*')
            ->select('(SELECT COUNT(*) FROM tbl_comment WHERE tbl_comment.comment_post_id = tbl_post.post_id) AS comment_total', false)
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->where('tbl_post.post_slug', $slug)
            ->limit(1)
            ->get();
    }
    public function count_views($user_ip, $post_id)
    {
        $this->db->transStart();
        $this->db->table('tbl_post_views')->insert([
            'view_ip' => $user_ip,
            'view_post_id' => $post_id,
        ]);
        $this->db->table('tbl_post')
            ->set('post_views', 'post_views+1', false)
            ->where('post_id', $post_id)
            ->update();
        $this->db->transComplete();
        if ($this->db->transStatus() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function get_related_post($category_id, $kode)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_user.user_name, tbl_user.user_photo')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->where('tbl_post.post_category_id', $category_id)
            ->where('tbl_post.post_id !=', $kode)
            ->orderBy('tbl_post.post_views', 'DESC')
            ->limit(4)
            ->get();
    }
    public function search_post($query)
    {
        return $this->db->table('tbl_post')
            ->select('tbl_post.*, tbl_user.user_name, tbl_user.user_photo')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->groupStart()
            ->like('tbl_post.post_title', $query)
            ->orLike('tbl_category.category_name', $query)
            ->orLike('tbl_post.post_tags', $query)
            ->groupEnd()
            ->limit(12)
            ->get();
    }
    public function get_all_post($user_id = null)
    {
        $builder = $this->db->table('tbl_post')
            ->select("tbl_post.post_id,tbl_post.post_title,tbl_post.post_slug,tbl_post.post_user_id,tbl_post.post_image,DATE_FORMAT(tbl_post.post_date,'%d %M %Y') AS post_date,tbl_category.category_name,tbl_post.post_tags,tbl_post.post_status,tbl_post.post_views", false)
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id');

        if ($user_id !== null) {
            $builder->where('tbl_post.post_user_id', $user_id);
        }

        return $builder->get();
    }
}
