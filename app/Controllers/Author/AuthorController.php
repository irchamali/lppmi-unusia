<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\SiteModel;
use App\Models\CommentModel;
use App\Models\VisitorModel;

class AuthorController extends BaseController
{
    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->siteModel = new SiteModel();
        $this->visitorModel = new VisitorModel();
    }
    public function index()
    {
        $visitor = $this->visitorModel->visitor_statistics();
        foreach ($visitor as $result) {
            $bulan[] = $result->tgl;
            $value[] = (float) $result->jumlah;
        }

        $monthly_visitors = $this->visitorModel->count_visitor_this_month();
        if ($monthly_visitors) {
            $visitor_this_month = $monthly_visitors->tot_visitor;
        } else {
            $visitor_this_month = 0;
        }
        $chrome_visitors = $this->visitorModel->count_chrome_visitors();
        if ($chrome_visitors) {
            $visitor_chrome = $chrome_visitors->chrome_visitor;
            $chrome_visitor = $visitor_this_month > 0 ? ($visitor_chrome / $visitor_this_month) * 100 : 0;
        } else {
            $chrome_visitor = 0;
        }
        $firefox_visitors = $this->visitorModel->count_firefox_visitors();
        if ($firefox_visitors) {
            $visitor_firefox = $firefox_visitors->firefox_visitor;
            $firefox_visitor = $visitor_this_month > 0 ? ($visitor_firefox / $visitor_this_month) * 100 : 0;
        } else {
            $firefox_visitor = 0;
        }
        $explorer_visitors = $this->visitorModel->count_explorer_visitors();
        if ($explorer_visitors) {
            $visitor_explorer = $explorer_visitors->explorer_visitor;
            $explorer_visitor = $visitor_this_month > 0 ? ($visitor_explorer / $visitor_this_month) * 100 : 0;
        } else {
            $explorer_visitor = 0;
        }
        $safari_visitors = $this->visitorModel->count_safari_visitors();
        if ($safari_visitors) {
            $visitor_safari = $safari_visitors->safari_visitor;
            $safari_visitor = $visitor_this_month > 0 ? ($visitor_safari / $visitor_this_month) * 100 : 0;
        } else {
            $safari_visitor = 0;
        }
        $opera_visitors = $this->visitorModel->count_opera_visitors();
        if ($opera_visitors) {
            $visitor_opera = $opera_visitors->opera_visitor;
            $opera_visitor = $visitor_this_month > 0 ? ($visitor_opera / $visitor_this_month) * 100 : 0;
        } else {
            $opera_visitor = 0;
        }
        $robot_visitors = $this->visitorModel->count_robot_visitors();
        if ($robot_visitors) {
            $visitor_robot = $robot_visitors->robot_visitor;
            $robot_visitor = $visitor_this_month > 0 ? ($visitor_robot / $visitor_this_month) * 100 : 0;
        } else {
            $robot_visitor = 0;
        }
        $other_visitors = $this->visitorModel->count_other_visitors();
        if ($other_visitors) {
            $visitor_other = $other_visitors->other_visitor;
            $other_visitor = $visitor_this_month > 0 ? ($visitor_other / $visitor_this_month) * 100 : 0;
        } else {
            $other_visitor = 0;
        }

        $data = [
            'site' => $this->siteModel->find(1),
            'akun' => $this->akun,
            'title' => 'Dashboard',
            'active' => $this->active,
            'total_comment' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->getCommentsAuthor(session('id'))->where('comment_status', 0)->get()->getResultArray(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'month' => json_encode($bulan),
            'value' => json_encode($value),
            'all_visitors' => $this->visitorModel->count_all_visitors(),
            'all_post_views' => $this->visitorModel->count_all_post_views(),
            'all_posts' => $this->visitorModel->count_all_posts(),
            'all_comments' => $this->visitorModel->count_all_comments(),
            'top_five_articles' => $this->visitorModel->top_five_articles(),
            'chrome_visitor' => $chrome_visitor,
            'firefox_visitor' => $firefox_visitor,
            'explorer_visitor' => $explorer_visitor,
            'safari_visitor' => $safari_visitor,
            'opera_visitor' => $opera_visitor,
            'robot_visitor' => $robot_visitor,
            'other_visitor' => $other_visitor
        ];

        return view('author/v_dashboard', $data);
    }
}
