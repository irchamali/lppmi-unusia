<?php

namespace App\Models;

use CodeIgniter\Model;

class AkreditasiModel extends Model
{
    protected $table         = 'v_aps';
    protected $primaryKey    = 'aps_id';
    protected $allowedFields = ['prodi_id','no_sk','thn_sk','peringkat','tgl_kadaluarsa','aps_link'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllAps($limit = 3)
    {
        $this->orderBy('created_at', 'DESC')
             ->where(['updated_at' => 1]);

        return $this->paginate($limit, 'documents');
    }

}
