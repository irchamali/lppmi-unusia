<?php
namespace App\Models;

use CodeIgniter\Model;

class PartnerCategoryModel extends Model
{
    protected $table = 'tbl_partner_categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name', 'category_slug'];

    public function getAllCategoriesWithPartners()
    {
        return $this->select('tbl_partner_categories.category_id, tbl_partner_categories.category_name, tbl_partner_categories.category_slug, COUNT(tbl_partners.partner_id) as total_partners')
                    ->join('tbl_partners', 'tbl_partners.category_id = tbl_partner_categories.category_id', 'left')
                    ->groupBy('tbl_partner_categories.category_id')
                    ->orderBy('total_partners', 'DESC')
                    ->findAll();
    }
    public function getPartner_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_partners.*, tbl_partner_categories.* 
            FROM tbl_partners 
            LEFT JOIN tbl_partner_categories ON tbl_partners.category_id = tbl_partner_categories.category_id 
            WHERE tbl_partner_categories.category_slug = ?", [$slug]);

        return $query->getResultArray(); // Mengembalikan dalam bentuk array
    }

}
