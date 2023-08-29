<?php

namespace App\Models;

use CodeIgniter\Model;

class LapModel extends Model
{
    protected $table         = 'v_report';
    protected $primaryKey    = 'lap_id';
    protected $allowedFields = ['lap_name','lap_unit','lap_link','lap_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'lap_created_at';
    protected $updatedField  = 'lap_updated_at';

    public function getAllLap($limit = 3)
    {
        $this->orderBy('lap_created_at', 'DESC')
             ->where(['lap_updated_at' => 1]);

        return $this->paginate($limit, 'documents');
    }

}
