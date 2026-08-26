<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoryAdminModel extends Model
{
    protected $table = 'tbl_category';  // Perbaiki tabel yang digunakan
    protected $primaryKey = 'category_id'; // Gunakan primary key yang benar
    protected $allowedFields = ['category_name', 'category_slug']; // Sesuaikan dengan kolom yang ada di tabel kategori

    public function getAllCategoriesWithPosts()
    {
        return $this->select('tbl_category.category_id, tbl_category.category_name, tbl_category.category_slug, COUNT(tbl_post.post_id) as total_posts')
                    ->join('tbl_post', 'tbl_post.post_category_id = tbl_category.category_id', 'left')
                    ->groupBy('tbl_category.category_id')
                    ->orderBy('total_posts', 'DESC')
                    ->findAll();
    }

}
