<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Ircham Ali" />
    <link rel="shortcut icon" href="<?= base_url(''); ?>assets/backend/images/favicons/apple-touch-icon.png">

    <!-- Styles -->
    <link href="/assets/backend/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/dropify.min.css" rel="stylesheet" type="text/css">
    <!-- plugins -->
    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

</head>

<body class="page-header-fixed  compact-menu  pace-done page-sidebar-fixed">
    <div class="overlay"></div>

    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>

            <div id="main-wrapper">
                <div class="row">
                    <?php foreach (['total' => ['All Documents', 'icon-folder', 'info'], 'submitted' => ['Submitted', 'icon-clock', 'default'], 'approved' => ['Approved', 'icon-check', 'success'], 'revised' => ['Need Revision', 'icon-pencil', 'warning']] as $key => $card) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel info-box panel-white"><div class="panel-body">
                            <div class="info-box-stats"><p class="counter"><?= number_format($key === 'total' ? $dashboard['total'] : $dashboard['statuses'][$key]); ?></p><span class="info-box-title"><?= $card[0]; ?></span></div>
                            <div class="info-box-icon"><i class="<?= $card[1]; ?>"></i></div>
                            <div class="info-box-progress"><div class="progress progress-xs progress-squared bs-n"><div class="progress-bar progress-bar-<?= $card[2]; ?>" style="width: 100%"></div></div></div>
                        </div></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-md-6"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title">Documents by Category</h4></div><div class="panel-body">
                        <?php if ($dashboard['categories'] === []) : ?><p class="text-muted">No documents available.</p><?php endif; ?>
                        <ul class="list-unstyled"><?php foreach ($dashboard['categories'] as $category => $count) : ?><li><?= esc($category); ?><span class="badge badge-info pull-right"><?= $count; ?></span></li><?php endforeach; ?></ul>
                    </div></div></div>
                    <div class="col-md-6"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title">Documents by Scope</h4></div><div class="panel-body">
                        <?php if ($dashboard['scopes'] === []) : ?><p class="text-muted">No documents available.</p><?php endif; ?>
                        <ul class="list-unstyled"><?php foreach ($dashboard['scopes'] as $scope => $count) : ?><li><?= esc($scope); ?><span class="badge badge-success pull-right"><?= $count; ?></span></li><?php endforeach; ?></ul>
                    </div></div></div>
                </div>
                <a href="<?= esc($documentUrl); ?>" class="btn btn-primary">View Documents</a>
            </div>

            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Ircham Ali.</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->

    <div class="cd-overlay"></div>

    <!-- Javascripts -->
    <script src="/assets/backend/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="/assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/backend/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="/assets/backend/plugins/pace-master/pace.min.js"></script>
    <script src="/assets/backend/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="/assets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/backend/plugins/switchery/switchery.min.js"></script>
    <script src="/assets/backend/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/classie.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/main.js"></script>
    <script src="/assets/backend/plugins/waves/waves.min.js"></script>
    <script src="/assets/backend/plugins/3d-bold-navigation/js/main.js"></script>
    <script src="/assets/backend/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="/assets/backend/plugins/moment/moment.js"></script>
    <script src="/assets/backend/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="/assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/js/dropify.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>

</body>

</html>