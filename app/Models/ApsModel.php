<?php

namespace App\Models;

use CodeIgniter\Model;

class ApsModel extends Model
{
    protected $table         = 'tbl_akreditasi';
    protected $primaryKey    = 'aps_id';
    protected $allowedFields = ['prodi_id','no_sk','thn_sk','peringkat','tgl_kadaluarsa','aps_link'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAps_by_category($slug)
    {
        return $this->db->table('tbl_akreditasi')
            ->select('tbl_akreditasi.*, tbl_prodi.*')
            ->join('tbl_prodi', 'tbl_akreditasi.prodi_id = tbl_prodi.prodi_id', 'left')
            ->where('tbl_prodi.prodi_slug', $slug)
            ->orderBy('tbl_akreditasi.created_at', 'DESC')
            ->get();
    }

    public function getAllAps($query)
    {
        return $this->db->table('tbl_akreditasi')
            ->select("tbl_akreditasi.aps_id, tbl_akreditasi.prodi_id, no_sk, thn_sk, peringkat, tgl_kadaluarsa, DATE_FORMAT(tbl_akreditasi.created_at, '%d %M %Y') AS created_at, prodi_nama, prodi_kode, prodi_strata, prodi_link", false)
            ->join('tbl_prodi', 'tbl_akreditasi.prodi_id = tbl_prodi.prodi_id')
            ->get();
    }
}
