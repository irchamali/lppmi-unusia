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
    <link href="/assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- plugins -->
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
                                <?php $isValidator = session('role') === 'validator'; ?>
                                <?php if (!$isValidator) : ?>
                                    <?php if (empty($documents)) : ?>
                                        <div class="alert alert-info">Belum ada dokumen approved pada fakultas/prodi Anda atau lingkup universitas yang bisa direlasikan.</div>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New Relation</button>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="table-responsive">
                                    <table id="mytable" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Dokumen</th>
                                                <th>Direlasikan Dengan</th>
                                                <th>Jenis Relasi</th>
                                                <th>Catatan</th>
                                                <th>Status</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $statusClass = ['approved' => 'label-success', 'revised' => 'label-warning', 'submitted' => 'label-default', 'rejected' => 'label-danger', 'archived' => 'label-info'];
                                            $no = 0;
                                            foreach ($relations as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no; ?></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['document_title']); ?> <small class="text-muted">(<?= esc($row['document_number']); ?>)</small></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['related_document_title']); ?> <small class="text-muted">(<?= esc($row['related_document_number']); ?>)</small></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['relation_name'] ?: 'Terkait'); ?></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['relation_notes'] ?: '-'); ?></td>
                                                    <?php $relStatus = $row['status'] ?: 'submitted'; ?>
                                                    <td style="vertical-align: middle;">
                                                        <span class="label <?= $statusClass[$relStatus] ?? 'label-default'; ?>" <?= $relStatus === 'submitted' ? 'style="background-color: #000;"' : ''; ?>><?= esc(ucfirst($relStatus)); ?></span>
                                                        <?php if (!empty($row['validation_notes'])) : ?><br><small class="text-muted"><?= esc($row['validation_notes']); ?></small><?php endif; ?>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <?php if ($isValidator) : ?>
                                                            <?php if ($relStatus === 'submitted') : ?>
                                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalValidate<?= $row['relation_id']; ?>" title="Validate relation">Validate</button>
                                                            <?php else : ?>
                                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalPreview<?= $row['relation_id']; ?>" title="View relation details"><i class="fa fa-eye"></i></button>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                Action <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ModalEdit<?= $row['relation_id']; ?>"><span class="icon-pencil"></span> Edit</a></li>
                                                                <li><a href="javascript:void(0);" class="delete" data-userid="<?= $row['relation_id']; ?>"><span class="icon-trash"></span> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                        <?php endif; ?>
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

    <?php if (!$isValidator) : ?>
    <!-- Modal Add-->
    <form id="add-row-form" action="/manager/document-relations" method="POST">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Document Relation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control select2" name="document_id" required>
                                <option value="">- Pilih Dokumen -</option>
                                <?php foreach ($documents as $row) : ?>
                                    <option value="<?= $row['document_id']; ?>"><?= esc($row['document_title']); ?> (<?= esc($row['document_number']); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" name="related_document_id" required>
                                <option value="">- Direlasikan Dengan -</option>
                                <?php foreach ($documents as $row) : ?>
                                    <option value="<?= $row['document_id']; ?>"><?= esc($row['document_title']); ?> (<?= esc($row['document_number']); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="relation_type_id" required>
                                <option value="">- Pilih Jenis Relasi -</option>
                                <?php foreach ($relationtypes as $row) : ?>
                                    <option value="<?= $row['relation_type_id']; ?>"><?= esc($row['relation_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="relation_notes" class="form-control" rows="2" placeholder="Catatan (opsional)"></textarea>
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
    foreach ($relations as $row) :
    ?>
        <!-- Modal Edit -->
        <form id="add-row-form" action="/manager/document-relations" method="post">
            <input type="hidden" name="_method" value="PUT">
            <div class="modal fade" id="ModalEdit<?= $row['relation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Document Relation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?= esc($row['document_title']); ?> &harr; <?= esc($row['related_document_title']); ?></label>
                            </div>
                            <div class="form-group">
                                <select name="relation_type_id" class="form-control" required>
                                    <option value="">- Pilih Jenis Relasi -</option>
                                    <?php foreach ($relationtypes as $erow) : ?>
                                        <option value="<?= $erow['relation_type_id']; ?>" <?= ($row['relation_type_id'] == $erow['relation_type_id']) ? 'selected' : ''; ?>><?= esc($erow['relation_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="relation_notes" class="form-control" rows="2" placeholder="Catatan (opsional)"><?= esc($row['relation_notes']); ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="relation_id" value="<?= $row['relation_id']; ?>" required>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

    <!-- Modal hapus-->
    <form id="add-row-form" action="/manager/document-relations" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Document Relation</h4>
                    </div>
                    <div class="modal-body">
                        <strong>Anda yakin mau menghapus relasi ini?</strong>
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
    <?php endif; ?>

    <?php if ($isValidator) : ?>
    <?php foreach ($relations as $row) : ?>
        <?php $relStatus = $row['status'] ?: 'submitted'; ?>
        <?php if ($relStatus === 'submitted') : ?>
        <!-- Modal Validate -->
        <div class="modal fade" id="ModalValidate<?= $row['relation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Validasi Relasi Dokumen</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong><?= esc($row['document_title']); ?></strong> (<?= esc($row['document_number']); ?>)<br>
                        &harr; <strong><?= esc($row['related_document_title']); ?></strong> (<?= esc($row['related_document_number']); ?>)<br>
                        Jenis Relasi: <?= esc($row['relation_name'] ?: 'Terkait'); ?></p>
                        <?php if (!empty($row['relation_notes'])) : ?><p><strong>Catatan Manager:</strong><br><?= nl2br(esc($row['relation_notes'])); ?></p><?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <form action="/validator/document-relations/<?= $row['relation_id']; ?>/revise" method="post" style="display: inline;">
                            <textarea name="validation_notes" class="form-control" rows="2" placeholder="Revision notes" required></textarea>
                            <button type="submit" class="btn btn-warning">Request Revision</button>
                        </form>
                        <form action="/validator/document-relations/<?= $row['relation_id']; ?>/reject" method="post" style="display: inline;">
                            <textarea name="validation_notes" class="form-control" rows="2" placeholder="Rejection notes" required></textarea>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                        <form action="/validator/document-relations/<?= $row['relation_id']; ?>/approve" method="post" style="display: inline;"><button type="submit" class="btn btn-success">Approve</button></form>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
        <!-- Modal Preview (read-only, already validated) -->
        <div class="modal fade" id="ModalPreview<?= $row['relation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detail Relasi Dokumen</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong><?= esc($row['document_title']); ?></strong> (<?= esc($row['document_number']); ?>)<br>
                        &harr; <strong><?= esc($row['related_document_title']); ?></strong> (<?= esc($row['related_document_number']); ?>)<br>
                        Jenis Relasi: <?= esc($row['relation_name'] ?: 'Terkait'); ?><br>
                        Status: <span class="label <?= $statusClass[$relStatus] ?? 'label-default'; ?>"><?= esc(ucfirst($relStatus)); ?></span></p>
                        <?php if (!empty($row['relation_notes'])) : ?><p><strong>Catatan Manager:</strong><br><?= nl2br(esc($row['relation_notes'])); ?></p><?php endif; ?>
                        <?php if (!empty($row['validation_notes'])) : ?><p><strong>Catatan Validasi:</strong><br><?= nl2br(esc($row['validation_notes'])); ?></p><?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>

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
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable').DataTable();
            $('.select2').each(function() {
                $(this).select2({
                    width: '100%',
                    dropdownParent: $(this).closest('.modal')
                });
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
    <?php elseif (session()->getFlashdata('msg') == 'error-same-document') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Dokumen tidak bisa direlasikan dengan dirinya sendiri.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-scope') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Dokumen di luar fakultas/prodi Anda tidak bisa direlasikan.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-duplicate') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Relasi dengan jenis yang sama sudah ada.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-document-not-found') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Relasi tidak ditemukan atau bukan wewenang Anda.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-validation-notes') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Catatan wajib diisi untuk revisi/penolakan.",
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
                text: "<?= $isValidator ? 'Relation Validated!' : 'New Relation Saved!'; ?>",
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
                text: "Relation Updated!",
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
                text: "Relation Deleted!.",
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
