<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'tbl_prodi';
    protected $primaryKey       = 'prodi_id';
    protected $allowedFields    = ['prodi_nama', 'prodi_kode','prodi_strata','prodi_link','prodi_email'];
    
}
