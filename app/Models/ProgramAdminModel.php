<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramAdminModel extends Model
{
    protected $table            = 'tbl_programs';
    protected $primaryKey       = 'program_id';
    protected $allowedFields    = ['program_title', 'program_slug', 'program_description', 'program_date', 'program_status', 'category_id', 'program_image'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getAllPrograms($onlyPublished = false)
    {
        $builder = $this->select('tbl_programs.*, tbl_program_categories.category_name')
                        ->join('tbl_program_categories', 'tbl_programs.category_id = tbl_program_categories.category_id', 'left')
                        ->orderBy('program_date', 'DESC');

        if ($onlyPublished) {
            $builder->where('program_status', 1);
        }

        return $builder->findAll();
    }

    public function get_program_by_slug($slug) 
    {
        $query = $this->db->query("
            SELECT tbl_programs.*, 
                tbl_program_categories.category_name,
                tbl_program_categories.category_slug
            FROM tbl_programs
            LEFT JOIN tbl_program_categories 
                ON tbl_programs.program_category_id = tbl_program_categories.category_id
            WHERE tbl_programs.program_slug = '$slug'
            GROUP BY tbl_programs.program_id
            LIMIT 1
        ");
        return $query;
    }

    public function getProgramBySlug($slug)
    {
        return $this->select('tbl_programs.*, tbl_program_categories.category_name')
                    ->join('tbl_program_categories', 'tbl_programs.category_id = tbl_program_categories.category_id', 'left')
                    ->where('program_slug', $slug)
                    ->first();
    }

    public function searchProgram($query)
    {
        return $this->select('tbl_programs.*, tbl_program_categories.category_name')
                    ->join('tbl_program_categories', 'tbl_programs.category_id = tbl_program_categories.category_id', 'left')
                    ->like('program_title', $query)
                    ->orLike('program_description', $query)
                    ->orLike('tbl_program_categories.category_name', $query)
                    ->findAll();
    }

    public function toggleProgramStatus($program_id)
    {
        $program = $this->find($program_id);
        if ($program) {
            $new_status = $program['program_status'] == 1 ? 0 : 1; // Toggle status
            return $this->update($program_id, ['program_status' => $new_status]);
        }
        return false;
    }
}
