<?php

namespace App\Models;

use CodeIgniter\Model;

class AkreditasiModel extends Model
{
    protected $table         = 'tbl_akreditasi';
    protected $primaryKey    = 'aps_id';
    protected $allowedFields = ['prodi_id','no_sk','thn_sk','peringkat','tgl_kadaluarsa','aps_link'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllAps(): array
    {
        return $this->db->table('tbl_akreditasi')
            ->select('tbl_akreditasi.*, tbl_prodi.prodi_nama')
            ->join('tbl_prodi', 'tbl_akreditasi.prodi_id = tbl_prodi.prodi_id', 'left')
            ->orderBy('tbl_akreditasi.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

}
