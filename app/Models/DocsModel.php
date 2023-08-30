<?php

namespace App\Models;

use CodeIgniter\Model;

class DocsModel extends Model
{
    protected $table         = 'v_docs';
    protected $primaryKey    = 'docs_id';
    protected $allowedFields = ['docs_name','docs_unit','docs_sk','docs_link','docs_category_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'docs_created_at';
    protected $updatedField  = 'docs_updated_at';

    public function getAllDocs($limit = 3)
    {
        $this->orderBy('docs_created_at', 'DESC')
             ->where(['docs_updated_at' => 1]);

        return $this->paginate($limit, 'documents');
    }

}
