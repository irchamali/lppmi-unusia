<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// HomeController
$routes->get('/', 'HomeController::index', ['filter' => 'logedin']);

// SubscribeController
$routes->get('subscribe', static function () {
    return redirect()->to('/#footer');
});
$routes->post('subscribe', 'SubscribeController::index');

// GalleryController
$routes->get('gallery', 'GalleryController::index');

// PostController (canonical plural routes)
$routes->get('posts', 'PostController::index');
$routes->get('posts/search', 'PostController::search');
$routes->get('p/(:segment)', 'PostController::index/$1');
$routes->get('posts/(:segment)', 'PostController::index/$1');
$routes->get('authors/(:num)', 'PostController::author/$1');
$routes->get('tags/(:segment)', 'PostController::tag/$1');

// CategoryController (canonical plural routes)
$routes->get('categories/(:segment)', 'CategoryController::index/$1');
$routes->get('d', 'DocumentController::index');
$routes->get('d/(:segment)', 'DocumentController::detail/$1');
$routes->get('documents/(:segment)', 'CategoryDocsController::index/$1');
$routes->get('r', 'LaporanController::index');
$routes->get('reports/detail/(:segment)', 'LaporanController::detail/$1');
$routes->get('r/(:segment)', 'LaporanController::detail/$1');
$routes->get('reports/(:segment)', 'LaporanController::show/$1');
$routes->get('aps', 'AkreditasiController::index');
$routes->get('aps/(:segment)', 'AkreditasiController::detail/$1');
$routes->get('aps/(:segment)', 'CategoryApsController::index/$1');

// Legacy singular aliases (backward compatibility)
$routes->get('search', 'PostController::search');
$routes->get('post', static function () {
    return redirect()->to('/posts');
});
$routes->get('post/(:segment)', static function ($slug) {
    return redirect()->to('/posts/' . $slug);
});
$routes->get('author/(:num)', static function ($id) {
    return redirect()->to('/authors/' . $id);
});
$routes->get('tag/(:segment)', static function ($tag) {
    return redirect()->to('/tags/' . $tag);
});
$routes->get('category/(:segment)', static function ($slug) {
    return redirect()->to('/categories/' . $slug);
});
$routes->get('document/(:segment)', static function ($slug) {
    return redirect()->to('/documents/' . $slug);
});
$routes->get('laporan/(:segment)', static function ($slug) {
    return redirect()->to('/reports/' . $slug);
});
$routes->get('report/(:segment)', static function ($slug) {
    return redirect()->to('/r/' . $slug);
});
$routes->get('report/detail/(:segment)', static function ($slug) {
    return redirect()->to('/r/' . $slug);
});

// AboutController
$routes->get('about', 'AboutController::index');
$routes->get('strategymap', 'AbStrategymapController::index');
$routes->get('milestone', 'AbMilestoneController::index');
$routes->get('deskripsitugas', 'AbFungtugasController::index');
$routes->get('strukturorganisasi', 'AbStrukturorgController::index');
$routes->get('team', 'AbTeamController::index');
$routes->get('alurkerja', 'AbAlurkerjaController::index');
$routes->get('monevrutin', 'AbMonevrutinController::index');

// AkreditasiController
$routes->get('akreditasi', 'AkreditasiController::index');
$routes->get('akreditasi/detail/(:segment)', 'AkreditasiController::detail/$1');
$routes->get('akreditasi/(:segment)', 'AkreditasiController::detail/$1');

// Controller pada Sub Menu Formulir
$routes->get('ami', 'AmiController::index');
$routes->get('auditnonakademik', 'FauditnonController::index');
$routes->get('renstra', 'FrenstraController::index');
$routes->get('renop', 'FrenopController::index');
$routes->get('lakin', 'FlakinController::index');
$routes->get('progressreport', 'FprogressController::index');
$routes->get('formspmi', 'FormspmiController::index');

// DocumentController
$routes->get('documents', 'DocumentController::index');
$routes->get('documents/detail/(:segment)', 'DocumentController::detail/$1');

// LaporanController
$routes->get('reports', 'LaporanController::index');

// Legacy singular aliases (backward compatibility)
$routes->get('document', static function () {
    return redirect()->to('/documents');
});
$routes->get('document/detail/(:segment)', static function ($slug) {
    return redirect()->to('/d/' . $slug);
});
$routes->get('laporan', static function () {
    return redirect()->to('/reports');
});

// ContactController
$routes->get('contact', 'ContactController::index');
$routes->post('contact', 'ContactController::inbox');

// PengaduanController
$routes->get('pengaduan', 'PengaduanController::index');

// LoginController & Logout
$routes->group('', ['filter' => 'logedin'], static function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login/validasi', 'LoginController::validasi');
});
$routes->get('logout', 'LoginController::logout');

// Admin Routes
$routes->group('admin', ['filter' => 'authadmin'], static function ($routes) {
    $routes->get('', 'Admin\AdminController::index');
    // Post Route
    $routes->group('post', static function ($routes) {
        $routes->get('', 'Admin\PostAdminController::index');
        $routes->get('toggle_status/(:num)', 'Admin\PostAdminController::toggle_status/$1');
        $routes->post('', 'Admin\PostAdminController::publish');
        $routes->delete('', 'Admin\PostAdminController::delete');
        $routes->put('', 'Admin\PostAdminController::update');
        $routes->get('add_new', 'Admin\PostAdminController::add_new');
        $routes->get('(:num)/edit', 'Admin\PostAdminController::edit/$1');
    });
    $routes->group('posts', static function ($routes) {
        $routes->get('', 'Admin\PostAdminController::index');
        $routes->get('toggle_status/(:num)', 'Admin\PostAdminController::toggle_status/$1');
        $routes->post('', 'Admin\PostAdminController::publish');
        $routes->delete('', 'Admin\PostAdminController::delete');
        $routes->put('', 'Admin\PostAdminController::update');
        $routes->get('add_new', 'Admin\PostAdminController::add_new');
        $routes->get('(:num)/edit', 'Admin\PostAdminController::edit/$1');
    });
    // Program Route
    $routes->group('program', static function ($routes) {
        $routes->get('', 'Admin\ProgramAdminController::index');
        $routes->get('add_new', 'Admin\ProgramAdminController::add_new');
        $routes->post('', 'Admin\ProgramAdminController::publish');
        $routes->put('', 'Admin\ProgramAdminController::update');
        $routes->delete('', 'Admin\ProgramAdminController::delete');
        $routes->get('toggle_status/(:num)', 'Admin\ProgramAdminController::toggle_status/$1');
        $routes->get('(:num)/edit', 'Admin\ProgramAdminController::edit/$1');
    });
    // Program Category Route
    $routes->group('procat', static function ($routes) {
        $routes->get('', 'Admin\ProgramCategoryController::index');
        $routes->post('', 'Admin\ProgramCategoryController::save');
        $routes->put('', 'Admin\ProgramCategoryController::edit');
        $routes->delete('', 'Admin\ProgramCategoryController::delete');
    });
    // Partner Route
    $routes->group('partner', static function ($routes) {
        $routes->get('', 'Admin\PartnerAdminController::index');
        $routes->post('', 'Admin\PartnerAdminController::insert');
        $routes->put('', 'Admin\PartnerAdminController::update');
        $routes->delete('', 'Admin\PartnerAdminController::delete');
        $routes->get('toggle_status/(:num)', 'Admin\PartnerAdminController::toggle_status/$1');
    });
    // Service Route
    $routes->group('service', static function ($routes) {
        $routes->get('', 'Admin\ServiceAdminController::index');
        $routes->post('', 'Admin\ServiceAdminController::insert');
        $routes->put('', 'Admin\ServiceAdminController::update');
        $routes->delete('', 'Admin\ServiceAdminController::delete');
    });
    // Partner Category Route
    $routes->group('partcat', static function ($routes) {
        $routes->get('', 'Admin\PartnerCategoryController::index');
        $routes->post('', 'Admin\PartnerCategoryController::save');
        $routes->put('', 'Admin\PartnerCategoryController::edit');
        $routes->delete('', 'Admin\PartnerCategoryController::delete');
    });
    // Category Route
    $routes->group('category', static function ($routes) {
        $routes->get('', 'Admin\CategoryAdminController::index');
        $routes->post('', 'Admin\CategoryAdminController::save');
        $routes->put('', 'Admin\CategoryAdminController::edit');
        $routes->delete('', 'Admin\CategoryAdminController::delete');
    });
    // Tag Route
    $routes->group('tag', static function ($routes) {
        $routes->get('', 'Admin\TagAdminController::index');
        $routes->post('', 'Admin\TagAdminController::save');
        $routes->put('', 'Admin\TagAdminController::edit');
        $routes->delete('', 'Admin\TagAdminController::delete');
    });
    // Inbox Route
    $routes->group('inbox', static function ($routes) {
        $routes->get('', 'Admin\InboxAdminController::index');
        $routes->get('(:num)', 'Admin\InboxAdminController::read/$1');
        $routes->delete('', 'Admin\InboxAdminController::delete');
    });
    // Comment Route
    $routes->group('comment', static function ($routes) {
        $routes->get('', 'Admin\CommentAdminController::index');
        $routes->post('', 'Admin\CommentAdminController::reply');
        $routes->post('publish', 'Admin\CommentAdminController::publish');
        $routes->put('', 'Admin\CommentAdminController::edit');
        $routes->delete('', 'Admin\CommentAdminController::delete');
        $routes->get('unpublish', 'Admin\CommentAdminController::unpublish');
    });
    // Subscriber Route
    $routes->group('subscriber', static function ($routes) {
        $routes->get('', 'Admin\SubscriberAdminController::index');
        $routes->delete('', 'Admin\SubscriberAdminController::delete');
        $routes->get('increase/(:num)', 'Admin\SubscriberAdminController::increase/$1');
        $routes->get('decrease/(:num)', 'Admin\SubscriberAdminController::decrease/$1');
        $routes->get('activate/(:num)', 'Admin\SubscriberAdminController::activate/$1');
        $routes->get('deactivate/(:num)', 'Admin\SubscriberAdminController::deactivate/$1');
    });
    // Documents Route
    $routes->group('document', static function ($routes) {
        $routes->get('', 'Admin\DocsAdminController::index');
        $routes->post('', 'Admin\DocsAdminController::insert');
        $routes->put('', 'Admin\DocsAdminController::update');
        $routes->delete('', 'Admin\DocsAdminController::delete');
    });
    // Documents Category Route
    $routes->group('docscategory', static function ($routes) {
        $routes->get('', 'Admin\DocsCategoryAdminController::index');
        $routes->post('', 'Admin\DocsCategoryAdminController::save');
        $routes->put('', 'Admin\DocsCategoryAdminController::edit');
        $routes->delete('', 'Admin\DocsCategoryAdminController::delete');
    });
    // Laporan Route
    $routes->group('laporan', static function ($routes) {
        $routes->get('', 'Admin\LapAdminController::index');
        $routes->post('', 'Admin\LapAdminController::insert');
        $routes->put('', 'Admin\LapAdminController::update');
        $routes->delete('', 'Admin\LapAdminController::delete');
    });
    // Laporan Category Route
    $routes->group('lapcategory', static function ($routes) {
        $routes->get('', 'Admin\LapCategoryAdminController::index');
        $routes->post('', 'Admin\LapCategoryAdminController::save');
        $routes->put('', 'Admin\LapCategoryAdminController::edit');
        $routes->delete('', 'Admin\LapCategoryAdminController::delete');
    });
    // Akreditasi Route
    $routes->group('akreditasi', static function ($routes) {
        $routes->get('', 'Admin\ApsAdminController::index');
        $routes->post('', 'Admin\ApsAdminController::insert');
        $routes->put('', 'Admin\ApsAdminController::update');
        $routes->delete('', 'Admin\ApsAdminController::delete');
    });
    // Prodi Route
    $routes->group('prodi', static function ($routes) {
        $routes->get('', 'Admin\ProdiAdminController::index');
        $routes->post('', 'Admin\ProdiAdminController::insert');
        $routes->put('', 'Admin\ProdiAdminController::update');
        $routes->delete('', 'Admin\ProdiAdminController::delete');
    });
    // Slider Route
    $routes->group('slider', static function ($routes) {
        $routes->get('', 'Admin\SliderAdminController::index');
        $routes->post('', 'Admin\SliderAdminController::insert');
        $routes->put('', 'Admin\SliderAdminController::update');
        $routes->delete('', 'Admin\SliderAdminController::delete');
    });
    // Member Route
    $routes->group('member', static function ($routes) {
        $routes->get('', 'Admin\MemberAdminController::index');
        $routes->post('', 'Admin\MemberAdminController::insert');
        $routes->put('', 'Admin\MemberAdminController::update');
        $routes->delete('', 'Admin\MemberAdminController::delete');
    });
    // Testimonial Route
    $routes->group('testimonial', static function ($routes) {
        $routes->get('', 'Admin\TestimonialAdminController::index');
        $routes->post('', 'Admin\TestimonialAdminController::insert');
        $routes->put('', 'Admin\TestimonialAdminController::update');
        $routes->delete('', 'Admin\TestimonialAdminController::delete');
    });
    // Team Route
    $routes->group('team', static function ($routes) {
        $routes->get('', 'Admin\TeamAdminController::index');
        $routes->post('', 'Admin\TeamAdminController::insert');
        $routes->put('', 'Admin\TeamAdminController::update');
        $routes->delete('', 'Admin\TeamAdminController::delete');
    });
    // Users Route
    $routes->group('users', static function ($routes) {
        $routes->get('', 'Admin\UsersAdminController::index');
        $routes->post('', 'Admin\UsersAdminController::insert');
        $routes->put('', 'Admin\UsersAdminController::update');
        $routes->delete('', 'Admin\UsersAdminController::delete');
        $routes->get('deactivate/(:num)', 'Admin\UsersAdminController::deactivate/$1');
        $routes->get('activate/(:num)', 'Admin\UsersAdminController::activate/$1');
    });
    // Setting Route
    $routes->group('setting', static function ($routes) {
        $routes->get('', static function () {
            return redirect()->to('admin/setting/profile');
        });
        // Setting My Profile
        $routes->get('profile', 'Admin\SettingAdminController::profile');
        $routes->post('profile', 'Admin\SettingAdminController::profile_update');
        $routes->put('profile', 'Admin\SettingAdminController::profile_password');
        // Setting Web
        $routes->get('web', 'Admin\SettingAdminController::web');
        $routes->put('web', 'Admin\SettingAdminController::web_update');

        // Setting Home
        $routes->get('home', 'Admin\SettingAdminController::home');
        $routes->put('home', 'Admin\SettingAdminController::home_update');

        // Setting About
        $routes->get('about', 'Admin\SettingAdminController::about');
        $routes->put('about', 'Admin\SettingAdminController::about_update');
    });
});

// Author Routes
$routes->group('author', ['filter' => 'authauthor'], static function ($routes) {
    $routes->get('', 'Author\AuthorController::index');
    // Post Route
    $routes->group('post', static function ($routes) {
        $routes->get('', 'Author\PostAuthorController::index');
        $routes->post('', 'Author\PostAuthorController::publish');
        $routes->delete('', 'Author\PostAuthorController::delete');
        $routes->put('', 'Author\PostAuthorController::update');
        $routes->get('add_new', 'Author\PostAuthorController::add_new');
        $routes->get('(:num)/edit', 'Author\PostAuthorController::edit/$1');
    });
    $routes->group('posts', static function ($routes) {
        $routes->get('', 'Author\PostAuthorController::index');
        $routes->post('', 'Author\PostAuthorController::publish');
        $routes->delete('', 'Author\PostAuthorController::delete');
        $routes->put('', 'Author\PostAuthorController::update');
        $routes->get('add_new', 'Author\PostAuthorController::add_new');
        $routes->get('(:num)/edit', 'Author\PostAuthorController::edit/$1');
    });
    // Category Route
    $routes->group('category', static function ($routes) {
        $routes->get('', 'Author\CategoryAuthorController::index');
        $routes->post('', 'Author\CategoryAuthorController::save');
        $routes->put('', 'Author\CategoryAuthorController::edit');
        $routes->delete('', 'Author\CategoryAuthorController::delete');
    });
    // Tag Route
    $routes->group('tag', static function ($routes) {
        $routes->get('', 'Author\TagAuthorController::index');
        $routes->post('', 'Author\TagAuthorController::save');
        $routes->put('', 'Author\TagAuthorController::edit');
        $routes->delete('', 'Author\TagAuthorController::delete');
    });
    // Comment Route
    $routes->group('comment', static function ($routes) {
        $routes->get('', 'Author\CommentAuthorController::index');
        $routes->post('', 'Author\CommentAuthorController::reply');
        $routes->post('publish', 'Author\CommentAuthorController::publish');
        $routes->put('', 'Author\CommentAuthorController::edit');
        $routes->delete('', 'Author\CommentAuthorController::delete');
        $routes->get('unpublish', 'Author\CommentAuthorController::unpublish');
    });
    // Setting Route
    $routes->group('setting', static function ($routes) {
        $routes->get('', static function () {
            return redirect()->to('author/setting/profile');
        });
        // Setting My Profile
        $routes->get('profile', 'Author\SettingAuthorController::profile');
        $routes->post('profile', 'Author\SettingAuthorController::profile_update');
        $routes->put('profile', 'Author\SettingAuthorController::profile_password');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
