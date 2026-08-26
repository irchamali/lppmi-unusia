<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table         = 'tbl_comment';
    protected $primaryKey    = 'comment_id';
    protected $allowedFields = ['comment_name', 'comment_email', 'comment_message', 'comment_status', 'comment_parent', 'comment_post_id', 'comment_image'];

    public function show_comments($post_id)
    {
        return $this->db->table($this->table)
            ->where('comment_post_id', $post_id)
            ->where('comment_status', 1)
            ->where('comment_parent', 0)
            ->orderBy('comment_date', 'DESC')
            ->get()
            ->getResult();
    }

    public function show_comments_reply($comment_id)
    {
        return $this->db->table($this->table)
            ->where('comment_status', 1)
            ->where('comment_parent', $comment_id)
            ->orderBy('comment_date', 'ASC')
            ->get()
            ->getResult();
    }

    public function get_all_comment()
    {
        return $this->db->table($this->table)
            ->select('tbl_comment.comment_id')
            ->select("DATE_FORMAT(tbl_comment.comment_date, '%d %M %Y %H:%i') AS comment_date", false)
            ->select('tbl_comment.comment_name, tbl_comment.comment_email, tbl_comment.comment_status, tbl_comment.comment_message, tbl_comment.comment_image')
            ->select('tbl_post.post_id, tbl_post.post_title, tbl_post.post_slug')
            ->join('tbl_post', 'tbl_comment.comment_post_id = tbl_post.post_id')
            ->where('tbl_comment.comment_parent', 0)
            ->orderBy('tbl_comment.comment_id', 'DESC')
            ->get()
            ->getResult();
    }

    public function get_all_comment_unpublish()
    {
        return $this->db->table($this->table)
            ->select('tbl_comment.comment_id')
            ->select("DATE_FORMAT(tbl_comment.comment_date, '%d %M %Y %H:%i') AS comment_date", false)
            ->select('tbl_comment.comment_name, tbl_comment.comment_email, tbl_comment.comment_status, tbl_comment.comment_message, tbl_comment.comment_image')
            ->select('tbl_post.post_id, tbl_post.post_title, tbl_post.post_slug')
            ->join('tbl_post', 'tbl_comment.comment_post_id = tbl_post.post_id')
            ->where('tbl_comment.comment_status', 0)
            ->orderBy('tbl_comment.comment_id', 'DESC')
            ->get()
            ->getResult();
    }

    public function get_replies_post($comment_id)
    {
        return $this->db->table($this->table)
            ->select('tbl_comment.comment_id')
            ->select("DATE_FORMAT(tbl_comment.comment_date, '%d %M %Y %H:%i') AS comment_date", false)
            ->select('tbl_comment.comment_name, tbl_comment.comment_email, tbl_comment.comment_message, tbl_comment.comment_image')
            ->select('tbl_post.post_id, tbl_post.post_title, tbl_post.post_slug')
            ->join('tbl_post', 'tbl_comment.comment_post_id = tbl_post.post_id')
            ->where('tbl_comment.comment_parent', $comment_id)
            ->orderBy('tbl_comment.comment_id', 'ASC')
            ->get()
            ->getResult();
    }

    public function getCommentsAuthor($user_id)
    {
        return $this->db->table($this->table)
            ->join('tbl_post', 'comment_post_id = post_id')
            ->where('post_user_id', $user_id);
    }
}

