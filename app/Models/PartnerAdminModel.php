<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerAdminModel extends Model
{
    protected $table            = 'tbl_partners';
    protected $primaryKey       = 'partner_id';
    protected $allowedFields    = ['partner_name', 'partner_desc', 'partner_date','partner_link','partner_status', 'category_id', 'partner_image'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getAllPartners($onlyPublished = false)
    {
        $builder = $this->select('tbl_partners.*, tbl_partner_categories.category_name')
                        ->join('tbl_partner_categories', 'tbl_partners.category_id = tbl_partner_categories.category_id', 'left')
                        ->orderBy('partner_date', 'DESC');

        if ($onlyPublished) {
            $builder->where('partner_status', 1);
        }

        return $builder->findAll();
    }

    public function getPartnerBySlug($slug)
    {
        return $this->select('tbl_partners.*, tbl_partner_categories.category_name')
                    ->join('tbl_partner_categories', 'tbl_partners.category_id = tbl_partner_categories.category_id', 'left')
                    ->where('partner_slug', $slug)
                    ->first();
    }

    public function searchPartner($query)
    {
        return $this->select('tbl_partners.*, tbl_partner_categories.category_name')
                    ->join('tbl_partner_categories', 'tbl_partners.category_id = tbl_partner_categories.category_id', 'left')
                    ->like('partner_name', $query)
                    ->orLike('partner_desc', $query)
                    ->orLike('tbl_partner_categories.category_name', $query)
                    ->findAll();
    }

    public function togglePartnerStatus($partner_id)
    {
        $partner = $this->find($partner_id);
        if ($partner) {
            $currentStatus = $partner['partner_status'];
            $currentStatusStr = strtolower((string) $currentStatus);
            $isStringStatus = is_string($currentStatus) && ! ctype_digit($currentStatus);

            $isActive = $currentStatusStr === 'active' || $currentStatusStr === '1' || (int) $currentStatus === 1;
            if ($isActive) {
                $new_status = $isStringStatus ? 'inactive' : 0;
            } else {
                $new_status = $isStringStatus ? 'active' : 1;
            }

            return $this->update($partner_id, ['partner_status' => $new_status]);
        }
        return false;
    }
}
