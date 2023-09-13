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
    <link rel="shortcut icon" href="/assets/frontend/img/apple-touch-icon.png">

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
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />

    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


</head>

<body class="page-header-fixed compact-menu pace-done page-sidebar-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <?= $this->include('layout/sidebar-dashboard'); ?>
        <div class="page-inner">
            <?= $this->include('layout/title-dashboard'); ?>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New Prodi</button>

                                <div class="table-responsive">
                                    <table id="data-table" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Prodi</th>
                                                <th>Slug</th>
                                                <th>Kode</th>
                                                <th>Strata</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $no = 0;
                                            foreach ($pstudies as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row['prodi_nama']; ?></td>
                                                    <td><?= $row['prodi_slug']; ?></td>
                                                    <td><?= $row['prodi_kode']; ?></td>
                                                    <td><?= $row['prodi_strata']; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalEdit<?= $row['prodi_id']; ?>"><span class="icon-pencil"></span> Edit</a>
                                                        <a href="javascript:void(0);" class="btn btn-xs btn-delete" data-id="<?= $row['prodi_id']; ?>"><span class="fa fa-trash"></span> Del</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Ircham Ali.</p>
            </div>
        </div><!-- Page Inner -->
    </main><!-- Page Content -->

    <!--ADD RECORD MODAL-->
    <form action="/<?= session('role'); ?>/prodi" method="POST">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Data Prodi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="prodiadd" class="form-control" placeholder="Nama Prodi" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="kodeps" class="form-control" placeholder="Kode Prodi" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="strata" class="form-control" placeholder="S1/S2/S3" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--EDIT RECORD MODAL-->
    
    <?php
    foreach ($pstudies as $row) :
    ?>
        <!-- Modal Edit -->
        <form id="add-row-form" action="/<?= session('role'); ?>/prodi" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="modal fade" id="ModalEdit<?= $row['prodi_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Prodi</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nama" value="<?= $row['prodi_nama']; ?>" class="form-control" placeholder="Nama Prodi" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="kode" value="<?= $row['prodi_kode']; ?>" class="form-control" placeholder="Kode Prodi" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="strata" value="<?= $row['prodi_strata']; ?>" class="form-control" placeholder="S1/S2/S3" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="link" class="form-control" rows="2" placeholder="Link Prodi" required><?= $row['prodi_link']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" value="<?= $row['prodi_email']; ?>" class="form-control" placeholder="Email Prodi" required>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="prodi_id" value="<?= $row['prodi_id']; ?>" required>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
    

    <!--DELETE RECORD MODAL-->
    <form action="/<?= session('role'); ?>/prodi" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Prodi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau menghapus data ini?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Javascripts -->
    <script src="/assets/backend/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="/assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
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
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').dataTable();

            //Edit Record
            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('prodi');
                $('[name="kode"]').val(id);
                $('[name="prodiedit"]').val(name);
                $('#EditModal').modal('show');
            });

            //Edit Record
            $('#body-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('[name="id"]').val(id);
                $('#DeleteModal').modal('show');
            });

        });
    </script>

    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Prodi Saved!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'info') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Prodi Updated!",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-delete') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Prodi Deleted!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php else : ?>

    <?php endif; ?>

</body>

</html>