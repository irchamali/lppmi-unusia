<?php

namespace App\Models;

use CodeIgniter\Model;

class PudosModel extends Model
{
    protected $table         = 'v_pudos';
    protected $primaryKey    = 'pudos_id';
    protected $allowedFields = ['pudos_title','pudos_name','pudos_publisher','pudos_link','pudos_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'pudos_created_at';
    protected $updatedField  = 'pudos_updated_at';

    public function getAllDocs($limit = 3)
    {
        $this->orderBy('pudos_created_at', 'DESC')
             ->where(['pudos_updated_at' => 1]);

        return $this->paginate($limit, 'documents');
    }

    public function getDocs_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_pudos.*,tbl_pudoscategory.* FROM
			tbl_pudos LEFT JOIN tbl_pudoscategory ON pudos_category_id=pudoscategory_id 
			WHERE pudoscategory_slug='$slug'
            ORDER BY tbl_pudos.pudos_created_at DESC"); // Menambahkan klausa ORDER BY
            
        return $query;
    }

}
