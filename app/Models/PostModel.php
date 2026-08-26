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
        return $this->select('tbl_post.*')
            ->select('tbl_user.user_name')
            ->select('tbl_user.user_photo')
            ->select('tbl_category.*')
            ->select('COUNT(tbl_comment.comment_id) AS comment_total', false)
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->join('tbl_comment', 'tbl_post.post_id = tbl_comment.comment_post_id', 'left')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->where('tbl_post.post_slug', $slug)
            ->groupBy('tbl_post.post_id')
            ->asArray()
            ->first();
    }

    public function count_views($user_ip, $post_id)
    {
        $this->db->transStart();

        $this->db->table('tbl_post_views')->insert([
            'view_ip' => $user_ip,
            'view_post_id' => $post_id,
        ]);

        $this->db->table($this->table)
            ->where('post_id', $post_id)
            ->set('post_views', 'post_views+1', false)
            ->update();

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function get_related_post($category_id, $exclude_post_id)
    {
        return $this->db->table($this->table)
            ->select('tbl_post.*')
            ->select('tbl_user.user_name')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->where('post_category_id', $category_id)
            ->where('post_id !=', $exclude_post_id)
            ->where('post_status', 1)
            ->orderBy('post_views', 'DESC')
            ->limit(4)
            ->get()
            ->getResult();
    }

    public function search_post($searchTerm)
    {
        return $this->db->table($this->table)
            ->select('tbl_post.*')
            ->select('tbl_user.user_name')
            ->select('tbl_user.user_photo')
            ->select('tbl_category.category_name')
            ->join('tbl_user', 'tbl_post.post_user_id = tbl_user.user_id', 'left')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
            ->groupStart()
                ->like('tbl_post.post_title', $searchTerm)
                ->orLike('tbl_category.category_name', $searchTerm)
                ->orLike('tbl_post.post_tags', $searchTerm)
            ->groupEnd()
            ->where('post_status', 1)
            ->limit(12)
            ->orderBy('post_date', 'DESC')
            ->get()
            ->getResult();
    }
    // public function get_all_post($user_id = null)
    // {
    //     if ($user_id == null) {
    //         $result = $this->db->query("SELECT post_id,post_title,post_slug,post_user_id,post_image,DATE_FORMAT(post_date,'%d %M %Y') AS post_date,category_name,post_tags,post_status,post_views FROM tbl_post JOIN tbl_category ON post_category_id=category_id");
    //         return $result;
    //     } else {
    //         $result = $this->db->query("SELECT post_id,post_title,post_slug,post_user_id,post_image,DATE_FORMAT(post_date,'%d %M %Y') AS post_date,category_name,post_tags,post_status,post_views FROM tbl_post JOIN tbl_category ON post_category_id=category_id where post_user_id=$user_id");
    //         return $result;
    //     }
    // }
    
    public function get_all_post($user_id = null, $is_admin = false)
    {
        $builder = $this->db->table($this->table)
            ->select('tbl_post.post_id, tbl_post.post_title, tbl_post.post_slug, tbl_post.post_user_id, tbl_post.post_image')
            ->select("DATE_FORMAT(tbl_post.post_date, '%d %M %Y') AS post_date", false)
            ->select('tbl_category.category_name, tbl_post.post_tags, tbl_post.post_status, tbl_post.post_views')
            ->join('tbl_category', 'tbl_post.post_category_id = tbl_category.category_id', 'left');

        if (! $is_admin) {
            $builder->where('tbl_post.post_status', 1);
        }

        if ($user_id !== null) {
            $builder->where('tbl_post.post_user_id', $user_id);
        }

        return $builder->orderBy('tbl_post.post_date', 'DESC')->get()->getResult();
    }

    // new function for toggle on admin post
    public function toggle_post_status($post_id)
    {
        $post = $this->find($post_id);
        if ($post) {
            $new_status = $post['post_status'] == 1 ? 0 : 1; // Toggle status
            return $this->update($post_id, ['post_status' => $new_status]);
        }
        return false;
    }

}
