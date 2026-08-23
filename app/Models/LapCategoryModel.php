<?php

namespace App\Models;

use CodeIgniter\Model;

class LapCategoryModel extends Model
{
    protected $table            = 'tbl_lapcategory';
    protected $primaryKey       = 'lapcategory_id';
    protected $allowedFields    = ['lapcategory_name', 'lapcategory_slug'];

    public function getLap_by_category($slug)
    {
        return $this->db->table('tbl_laporan')
            ->select('tbl_laporan.*, tbl_lapcategory.*')
            ->join('tbl_lapcategory', 'tbl_laporan.lap_category_id = tbl_lapcategory.lapcategory_id', 'left')
            ->where('tbl_lapcategory.lapcategory_slug', $slug)
            ->orderBy('tbl_laporan.lap_created_at', 'DESC')
            ->get();
    }
    
}
