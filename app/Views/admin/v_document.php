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
                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">
                                <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New Document</button>
                                <div class="table-responsive">
                                    <table id="mytable" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Dokumen</th>
                                                <th>Nomor</th>
                                                <th>Kategori</th>
                                                <th>Tipe</th>
                                                <th>Lingkup</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $no = 0;
                                            foreach ($documents as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['document_title']; ?></td>
                                                    <td style="vertical-align: middle;"><a href="<?= $row['document_file']; ?>" target="_blank"><?= $row['document_number']; ?></a></td>
                                                    <td style="vertical-align: middle;"><?= $row['category_name']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['type_name']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['scope_name']; ?></td>
                                                    <td style="vertical-align: middle;"><span class="label label-info"><?= $row['status']; ?></span></td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                Action <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ModalEdit<?= $row['document_id']; ?>"><span class="icon-pencil"></span> Edit</a></li>
                                                                <li><a href="javascript:void(0);" class="delete" data-userid="<?= $row['document_id']; ?>"><span class="icon-trash"></span> Delete</a></li>
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

    <!-- Modal Add-->
    <form id="add-row-form" action="/<?= session('role'); ?>/document" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Document</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Judul Dokumen" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="number" class="form-control" placeholder="Nomor Dokumen" required>
                        </div>
                        <div class="form-group">
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <textarea type="url" name="file_link" class="form-control" placeholder="Link misal: https://drive.google.com/" required></textarea>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="category_id" required>
                                <option value="">- Pilih Kategori -</option>
                                <?php foreach ($categories as $row) : ?>
                                    <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="type_id" required>
                                <option value="">- Pilih Tipe Dokumen -</option>
                                <?php foreach ($types as $row) : ?>
                                    <option value="<?= $row['type_id']; ?>"><?= $row['type_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="scope_id" required>
                                <option value="">- Pilih Lingkup -</option>
                                <?php foreach ($scopes as $row) : ?>
                                    <option value="<?= $row['scope_id']; ?>"><?= $row['scope_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="ppepp_stage">
                                <option value="">- Tahap PPEPP (Opsional) -</option>
                                <option value="penetapan">Penetapan</option>
                                <option value="pelaksanaan">Pelaksanaan</option>
                                <option value="evaluasi">Evaluasi</option>
                                <option value="pengendalian">Pengendalian</option>
                                <option value="peningkatan">Peningkatan</option>
                            </select>
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
    foreach ($documents as $row) :
    ?>
        <!-- Modal Edit -->
        <form id="add-row-form" action="/<?= session('role'); ?>/document" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="modal fade" id="ModalEdit<?= $row['document_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Document</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="title" value="<?= $row['document_title']; ?>" class="form-control" placeholder="Judul Dokumen" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="number" value="<?= $row['document_number']; ?>" class="form-control" placeholder="Nomor Dokumen" required>
                            </div>
                            <div class="form-group">
                                <input type="date" name="date" value="<?= $row['document_date']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <textarea name="file_link" class="form-control" rows="2" placeholder="Share Link Google Drive" required><?= $row['document_file']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <select name="category_id" class="form-control" required>
                                    <option value="">-Select Category-</option>
                                    <?php foreach($categories as $erow): ?>
                                    <option value="<?= $erow['category_id']; ?>" <?= ($row['category_id'] == $erow['category_id'])?'selected': '' ?>><?= $erow['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="type_id" class="form-control" required>
                                    <option value="">-Select Type-</option>
                                    <?php foreach($types as $erow): ?>
                                    <option value="<?= $erow['type_id']; ?>" <?= ($row['type_id'] == $erow['type_id'])?'selected': '' ?>><?= $erow['type_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="scope_id" class="form-control" required>
                                    <option value="">-Select Scope-</option>
                                    <?php foreach($scopes as $erow): ?>
                                    <option value="<?= $erow['scope_id']; ?>" <?= ($row['scope_id'] == $erow['scope_id'])?'selected': '' ?>><?= $erow['scope_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="ppepp_stage">
                                    <option value="">- Tahap PPEPP (Opsional) -</option>
                                    <option value="penetapan" <?= ($row['ppepp_stage'] == 'penetapan')?'selected': '' ?>>Penetapan</option>
                                    <option value="pelaksanaan" <?= ($row['ppepp_stage'] == 'pelaksanaan')?'selected': '' ?>>Pelaksanaan</option>
                                    <option value="evaluasi" <?= ($row['ppepp_stage'] == 'evaluasi')?'selected': '' ?>>Evaluasi</option>
                                    <option value="pengendalian" <?= ($row['ppepp_stage'] == 'pengendalian')?'selected': '' ?>>Pengendalian</option>
                                    <option value="peningkatan" <?= ($row['ppepp_stage'] == 'peningkatan')?'selected': '' ?>>Peningkatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="document_id" value="<?= $row['document_id']; ?>" required>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

    <!-- Modal hapus-->
    <form id="add-row-form" action="/<?= session('role'); ?>/document" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Document</h4>
                    </div>
                    <div class="modal-body">
                        <strong>Anda yakin mau menghapus document ini?</strong>
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

            $('#body-table').on('click', '.delete', function() {
                var userid = $(this).data('userid');
                $('#ModalDelete').modal('show');
                $('[name="kode"]').val(userid);
            });
        });
    </script>


    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Invalid input",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-img') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Image Upload Error.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "New Document Saved!",
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
                text: "Document updated!",
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
                text: "Document Deleted!.",
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