<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'tbl_prodi';
    protected $primaryKey       = 'prodi_id';
    protected $allowedFields    = ['fak_id', 'prodi_nama', 'prodi_slug', 'prodi_kode', 'prodi_strata', 'prodi_link', 'prodi_email'];
}
