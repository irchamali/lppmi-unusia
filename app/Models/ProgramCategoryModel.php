<?php
namespace App\Models;

use CodeIgniter\Model;

class ProgramCategoryModel extends Model
{
    protected $table = 'tbl_program_categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name', 'category_slug'];

    public function getAllCategoriesWithPrograms()
    {
        return $this->select('tbl_program_categories.category_id, tbl_program_categories.category_name, tbl_program_categories.category_slug, COUNT(tbl_programs.program_id) as total_programs')
                    ->join('tbl_programs', 'tbl_programs.category_id = tbl_program_categories.category_id', 'left')
                    ->groupBy('tbl_program_categories.category_id')
                    ->orderBy('total_programs', 'DESC')
                    ->findAll();
    }
}
