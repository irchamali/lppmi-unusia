<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\SliderModel;
use App\Models\TestimonialModel;
use App\Models\MemberModel;
use App\Models\PostviewModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->sliderModel = new SliderModel();
        $this->testimonialModel = new TestimonialModel();
        $this->memberModel = new MemberModel();
        $this->postviewModel = new PostviewModel();
    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'testimonials' => $this->testimonialModel->findAll(),
            'members' => $this->memberModel->findAll(),
            'sliders' => $this->sliderModel->findAll(),
            'latest_posts' => $this->postviewModel->getLatestPosts(),
            // 'posts' => $this->postviewModel->paginate(3, 'posts'),
            'pager' => $this->postviewModel->pager,
            'validation' => \Config\Services::validation(),
            'title' => 'Home',
            'active' => 'Home'
        ];
        return view('home_view', $data);
    }
}
