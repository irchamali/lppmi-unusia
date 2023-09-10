<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title><?= $title; ?></title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
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
    <link href="/assets/backend/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/dropify.min.css" rel="stylesheet" type="text/css">

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
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New</button>
                                <div class="table-responsive">
                                    <table id="mytable" class="display table" style="width: 100%; ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Jabatan</th>
                                            <th>CV</th>
                                            <th>facebook</th>
                                            <th>instagram</th>
                                            <th>linkedin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table">
                                        <?php
                                        $no = 0;
                                        foreach ($teams as $row) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?= $no; ?></td>
                                                <td style="vertical-align: middle;">
                                                    <?php if (empty($row['team_image'])) : ?>
                                                        <img class="img-circle" width="50" src="/assets/backend/images/team/user_blank.jpg">
                                                    <?php else : ?>
                                                        <img class="img-circle" width="50" src="/assets/backend/images/team/<?= $row['team_image']; ?>">
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_name']; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_jabatan']; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_twitter']; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_facebook']; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_instagram']; ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?= $row['team_linked']; ?>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ModalEdit<?= $row['team_id']; ?>"><span class="icon-pencil"></span> Edit</a></li>
                                                            <li><a href="javascript:void(0);" class="delete" data-userid="<?= $row['team_id']; ?>"><span class="icon-trash"></span> Delete</a></li>
                                                        </ul>
                                                    </div>
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

    <div class="cd-overlay"></div>

    <!-- Modal Add -->
    <form id="add-row-form" action="/<?= session('role'); ?>/team" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Team</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="file" name="filefoto" class="dropify" data-height="180">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="twitter" class="form-control" placeholder="link cv anda!" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="linked" class="form-control" placeholder="https://linkedin.com/" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    foreach ($teams as $row) :
    ?>
        <!-- Modal Edit -->
        <form id="add-row-form" action="/<?= session('role'); ?>/team" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
            <div class="modal fade" id="ModalEdit<?= $row['team_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Team</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="file" name="filefoto" class="dropify" data-height="180" data-default-file="/assets/backend/images/team/<?= $row['team_image']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="nama" value="<?= $row['team_name']; ?>" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="jabatan" value="<?= $row['team_jabatan']; ?>" class="form-control" placeholder="Jabatan" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="twitter" value="<?= $row['team_twitter']; ?>" class="form-control" placeholder="link cv anda!" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="facebook" value="<?= $row['team_facebook']; ?>" class="form-control" placeholder="https://facebook.com/" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="instagram" value="<?= $row['team_instagram']; ?>" class="form-control" placeholder="https://instagram.com/" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="linked" value="<?= $row['team_linked']; ?>" class="form-control" placeholder="https://linkedin.com/" required>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="team_id" value="<?= $row['team_id']; ?>" required>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

    <!-- Modal hapus-->
    <form id="add-row-form" action="/<?= session('role'); ?>/team" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Team</h4>
                    </div>
                    <div class="modal-body">
                        <strong>Anda yakin mau menghapus orang ini?</strong>
                        <div class="form-group">
                            <input type="hidden" id="txt_kode" name="kode" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="add-row" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Javascripts -->
    <script src="/assets/backend/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="/assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/backend/plugins/select2/js/select2.min.js" type="text/javascript">
    </script>
    <script src="/assets/backend/plugins/pace-master/pace.min.js"></script>
    <script src="/assets/backend/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="/assets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <script src="/assets/backend/plugins/switchery/switchery.min.js"></script>
    <script src="/assets/backend/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/classie.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/main.js"></script>
    <script src="/assets/backend/plugins/waves/waves.min.js"></script>
    <script src="/assets/backend/plugins/3d-bold-navigation/js/main.js"></script>
    <script src="/assets/backend/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="/assets/backend/plugins/moment/moment.js"></script>
    <script src="/assets/backend/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="/assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js">
    </script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/js/dropify.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable').DataTable();
            $('.dropify').dropify({
                defaultFile: '',
                messages: {
                    default: 'Drag atau drop untuk memilih Photo',
                    replace: 'Ganti',
                    remove: 'Hapus',
                    error: 'error'
                }
            });

            $('#body-table').on('click','.delete', function() {
                var userid = $(this).data('userid');
                $('#ModalDelete').modal('show');
                $('[name="kode"]').val(userid);
            });
        });
    </script>


    <!--Toast Message-->
    <?php if (session()->getFlashData('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Invalid Input",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "New Team Saved!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'info') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Team updated!",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'success-delete') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Team Deleted!.",
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