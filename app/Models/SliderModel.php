<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table         = 'tbl_slider';
    protected $primaryKey    = 'slider_id';
    protected $allowedFields = ['slider_title', 'slider_subtitle','slider_link', 'slider_image'];
    protected $useTimestamps = true;
    protected $createdField  = 'slider_created_at';
    protected $updatedField  = 'slider_updated_at';
}
