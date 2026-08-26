<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceAdminModel extends Model
{
    protected $table            = 'tbl_services';
    protected $primaryKey       = 'service_id';
    protected $allowedFields    = ['service_name', 'service_slug', 'service_desc', 'service_desc2', 'service_link', 'service_image'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getAllServices()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getServiceBySlug($slug)
    {
        return $this->where('service_slug', $slug)->first();
    }

    public function searchService($query)
    {
        return $this->like('service_name', $query)
                    ->orLike('service_desc', $query)
                    ->findAll();
    }
}
