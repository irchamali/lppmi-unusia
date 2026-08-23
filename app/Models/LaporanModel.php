<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table         = 'tbl_laporan';
    protected $primaryKey    = 'lap_id';
    protected $allowedFields = ['lap_name','lap_unit','lap_year','lap_link','lap_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'lap_created_at';
    protected $updatedField  = 'lap_updated_at';

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
