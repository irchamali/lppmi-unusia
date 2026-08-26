<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'tbl_visitors';
    protected $primaryKey       = 'visit_id';
    protected $allowedFields    = ['visit_date', 'visit_ip', 'visit_platform'];

    public function count_visitor($user_ip, $agent)
    {
        $exists = $this->db->table($this->table)
            ->where('visit_ip', $user_ip)
            ->where('DATE(visit_date)', 'CURDATE()', false)
            ->countAllResults();

        if ($exists < 1) {
            return $this->db->table($this->table)->insert([
                'visit_ip' => $user_ip,
                'visit_platform' => $agent,
            ]);
        }

        return true;
    }

    public function visitor_statistics()
    {
        return $this->db->table($this->table)
            ->select("DATE_FORMAT(visit_date, '%d') AS tgl", false)
            ->select('COUNT(visit_ip) AS jumlah')
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->groupBy("DATE_FORMAT(visit_date, '%d')", false)
            ->orderBy('tgl', 'ASC')
            ->get()
            ->getResult();
    }

    function count_all_visitors()
    {
        $query = $this->db->table('tbl_visitors')->countAll();
        return $query;
    }

    function count_all_post_views()
    {
        $query = $this->db->table('tbl_post_views')->countAll();
        return $query;
    }

    function count_all_posts()
    {
        $query = $this->db->table('tbl_post')->countAll();
        return $query;
    }

    function count_all_comments()
    {
        $query = $this->db->table('tbl_comment')->countAll();
        return $query;
    }

    function top_five_articles()
    {
        return $this->db->table('tbl_post')
            ->orderBy('post_views', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();
    }

    function count_visitor_this_month()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS tot_visitor', false)
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_chrome_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS chrome_visitor', false)
            ->where('visit_platform', 'Chrome')
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_firefox_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS firefox_visitor', false)
            ->groupStart()
                ->where('visit_platform', 'Firefox')
                ->orWhere('visit_platform', 'Mozilla')
            ->groupEnd()
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_explorer_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS explorer_visitor', false)
            ->where('visit_platform', 'Internet Explorer')
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_safari_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS safari_visitor', false)
            ->where('visit_platform', 'Safari')
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_opera_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS opera_visitor', false)
            ->where('visit_platform', 'Opera')
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_robot_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS robot_visitor', false)
            ->groupStart()
                ->where('visit_platform', 'YandexBot')
                ->orWhere('visit_platform', 'Googlebot')
                ->orWhere('visit_platform', 'Yahoo')
            ->groupEnd()
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->get()
            ->getRow();
    }

    function count_other_visitors()
    {
        return $this->db->table($this->table)
            ->select('COUNT(*) AS other_visitor', false)
            ->where('MONTH(visit_date)', 'MONTH(CURDATE())', false)
            ->where('visit_platform !=', 'YandexBot')
            ->where('visit_platform !=', 'Googlebot')
            ->where('visit_platform !=', 'Yahoo')
            ->where('visit_platform !=', 'Chrome')
            ->where('visit_platform !=', 'Firefox')
            ->where('visit_platform !=', 'Mozilla')
            ->where('visit_platform !=', 'Internet Explorer')
            ->where('visit_platform !=', 'Safari')
            ->where('visit_platform !=', 'Opera')
            ->get()
            ->getRow();
    }
}
