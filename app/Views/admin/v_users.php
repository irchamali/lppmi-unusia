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
                                <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New User</button>
                                <div class="table-responsive">
                                    <table id="mytable" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Document Assignments</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            <?php
                                            $no = 0;
                                            foreach ($users as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no; ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <?php if (empty($row['user_photo'])) : ?>
                                                            <img class="img-circle" width="50" src="/assets/backend/images/user_blank.png">
                                                        <?php else : ?>
                                                            <img class="img-circle" width="50" src="/assets/backend/images/users/<?= $row['user_photo']; ?>">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"><?= $row['user_name']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['user_email']; ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        $roles = ['1' => 'Administrator', '2' => 'Author', '3' => 'Manager', '4' => 'Validator'];
                                                        echo $roles[$row['user_level']] ?? 'Unknown';
                                                        ?>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <?php foreach ($userScopes[$row['user_id']] ?? [] as $assignment) : ?>
                                                            <div><?= esc($assignment['scope_name']); ?><?= !empty($assignment['fak_name']) ? ' - ' . esc($assignment['fak_name']) : ''; ?><?= !empty($assignment['prodi_nama']) ? ' - ' . esc($assignment['prodi_nama']) : ''; ?></div>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <?php if ($row['user_status'] == '1') : ?>
                                                        <td style="vertical-align: middle;"><a href="/<?= session('role'); ?>/users/deactivate/<?= $row['user_id']; ?>" class="btn"><span class="fa fa-check-square-o" title="Active"></span></a></td>
                                                    <?php else : ?>
                                                        <td style="vertical-align: middle;"><a href="/<?= session('role'); ?>/users/activate/<?= $row['user_id']; ?>" class="btn"><span class="fa fa-square-o" title="Deactive"></span></a></td>
                                                    <?php endif; ?>
                                                    <td style="vertical-align: middle;">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                Action <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ModalEdit<?= $row['user_id']; ?>"><span class="icon-pencil"></span> Edit</a></li>
                                                                <li><a href="javascript:void(0);" class="delete" data-userid="<?= $row['user_id']; ?>"><span class="icon-trash"></span> Delete</a></li>
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

    <!-- Modal Insert -->
    <form id="add-row-form" action="/<?= session('role'); ?>/users" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New User</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="file" name="filefoto" class="dropify" data-height="220">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="level" required>
                                        <option value="">No Selected</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Author</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Validator</option>
                                    </select>
                                </div>
                                <div class="document-scope-assignments" style="display: none;">
                                    <label>Document Scope Assignments</label>
                                    <div class="scope-assignment-row row">
                                        <div class="col-sm-4"><select class="form-control assignment-scope" name="assignment_scope_id[]"><option value="">Scope</option><?php foreach ($scopes as $scope) : ?><option value="<?= $scope['scope_id']; ?>" data-scope-slug="<?= esc($scope['scope_slug']); ?>"><?= esc($scope['scope_name']); ?></option><?php endforeach; ?></select></div>
                                        <div class="col-sm-3"><select class="form-control assignment-fakultas" name="assignment_fak_id[]"><option value="">Fakultas</option><?php foreach ($fakultas as $fakultasRow) : ?><option value="<?= $fakultasRow['fak_id']; ?>"><?= esc($fakultasRow['fak_name']); ?></option><?php endforeach; ?></select></div>
                                        <div class="col-sm-3"><select class="form-control assignment-prodi" name="assignment_prodi_id[]"><option value="">Program Studi</option><?php foreach ($prodi as $prodiRow) : ?><option value="<?= $prodiRow['prodi_id']; ?>" data-fak-id="<?= $prodiRow['fak_id']; ?>"><?= esc($prodiRow['prodi_nama']); ?></option><?php endforeach; ?></select></div>
                                        <div class="col-sm-2"><button type="button" class="btn btn-danger remove-assignment"><i class="fa fa-trash"></i></button></div>
                                    </div>
                                    <button type="button" class="btn btn-default btn-sm add-assignment" onclick="addScopeAssignment(this); return false;"><i class="fa fa-plus"></i> Add Assignment</button>
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
    foreach ($users as $row) :
    ?>

        <!-- Modal  Update-->
        <form id="add-row-form" action="/<?= session('role'); ?>/users" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="modal fade" id="ModalEdit<?= $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="file" name="filefoto" class="dropify" data-height="220" data-default-file="/assets/backend/images/users/<?= $row['user_photo']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="nama" value="<?= $row['user_name']; ?>" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" value="<?= $row['user_email']; ?>" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="level" required>
                                            <option value="1" <?= $row['user_level'] == '1' ? 'selected' : ''; ?>>Administrator</option>
                                            <option value="2" <?= $row['user_level'] == '2' ? 'selected' : ''; ?>>Author</option>
                                            <option value="3" <?= $row['user_level'] == '3' ? 'selected' : ''; ?>>Manager</option>
                                            <option value="4" <?= $row['user_level'] == '4' ? 'selected' : ''; ?>>Validator</option>
                                        </select>
                                    </div>
                                    <div class="document-scope-assignments" style="display: none;">
                                        <label>Document Scope Assignments</label>
                                        <?php $assignments = $userScopes[$row['user_id']] ?? [[]]; ?>
                                        <?php foreach ($assignments as $assignment) : ?>
                                        <div class="scope-assignment-row row">
                                            <div class="col-sm-4"><select class="form-control assignment-scope" name="assignment_scope_id[]"><option value="">Scope</option><?php foreach ($scopes as $scope) : ?><option value="<?= $scope['scope_id']; ?>" data-scope-slug="<?= esc($scope['scope_slug']); ?>" <?= (($assignment['scope_id'] ?? null) == $scope['scope_id']) ? 'selected' : ''; ?>><?= esc($scope['scope_name']); ?></option><?php endforeach; ?></select></div>
                                            <div class="col-sm-3"><select class="form-control assignment-fakultas" name="assignment_fak_id[]"><option value="">Fakultas</option><?php foreach ($fakultas as $fakultasRow) : ?><option value="<?= $fakultasRow['fak_id']; ?>" <?= (($assignment['fak_id'] ?? null) == $fakultasRow['fak_id']) ? 'selected' : ''; ?>><?= esc($fakultasRow['fak_name']); ?></option><?php endforeach; ?></select></div>
                                            <div class="col-sm-3"><select class="form-control assignment-prodi" name="assignment_prodi_id[]"><option value="">Program Studi</option><?php foreach ($prodi as $prodiRow) : ?><option value="<?= $prodiRow['prodi_id']; ?>" data-fak-id="<?= $prodiRow['fak_id']; ?>" <?= (($assignment['prodi_id'] ?? null) == $prodiRow['prodi_id']) ? 'selected' : ''; ?>><?= esc($prodiRow['prodi_nama']); ?></option><?php endforeach; ?></select></div>
                                            <div class="col-sm-2"><button type="button" class="btn btn-danger remove-assignment"><i class="fa fa-trash"></i></button></div>
                                        </div>
                                        <?php endforeach; ?>
                                        <button type="button" class="btn btn-default btn-sm add-assignment" onclick="addScopeAssignment(this); return false;"><i class="fa fa-plus"></i> Add Assignment</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>" required>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

    <!-- Modal hapus-->
    <form id="add-row-form" action="/<?= session('role'); ?>/users" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                    </div>
                    <div class="modal-body">
                        <strong>Anda yakin mau menghapus user ini?</strong>
                        <div class="form-group">
                            <input type="hidden" id="txt_kode" name="kode" class="form-control" placeholder="Name" required>
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

            $('#table-body').on('click', '.delete', function() {
                var userid = $(this).data('userid');
                $('#ModalDelete').modal('show');
                $('[name="kode"]').val(userid);
            });

            function updateAssignmentRow(row) {
                var slug = row.find('.assignment-scope option:selected').data('scope-slug') || '';
                var requiresFakultas = slug.indexOf('fakultas') !== -1 || slug.indexOf('prodi') !== -1;
                var requiresProdi = slug.indexOf('prodi') !== -1;
                var fakultas = row.find('.assignment-fakultas');
                var prodi = row.find('.assignment-prodi');
                fakultas.closest('.col-sm-3').toggle(requiresFakultas);
                prodi.closest('.col-sm-3').toggle(requiresProdi);
                fakultas.prop('required', requiresFakultas);
                prodi.prop('required', requiresProdi);
                prodi.find('option[data-fak-id]').each(function() {
                    $(this).toggle(!requiresProdi || !fakultas.val() || $(this).data('fak-id') == fakultas.val());
                });
            }

            function updateAssignments(form) {
                var enabled = ['3', '4'].indexOf(form.find('[name="level"]').val()) !== -1;
                form.find('.document-scope-assignments').toggle(enabled);
                form.find('.scope-assignment-row').each(function() { updateAssignmentRow($(this)); });
            }

            $('form[action$="/users"]').each(function() { updateAssignments($(this)); });
            $(document).on('change', '[name="level"], .assignment-scope, .assignment-fakultas', function() {
                updateAssignments($(this).closest('form'));
            });
            window.addScopeAssignment = function(button) {
                var assignments = $(button).closest('.document-scope-assignments');
                var firstRow = assignments.find('.scope-assignment-row:first');
                if (!firstRow.length) {
                    return;
                }
                var row = firstRow.clone(false, false).removeAttr('style').show();
                row.find('select').val('');
                row.find('option[data-fak-id]').show();
                row.find('.assignment-fakultas, .assignment-prodi').closest('.col-sm-3').show();
                $(button).before(row);
                updateAssignmentRow(row);
            };
            $(document).on('click', '.remove-assignment', function(event) {
                event.preventDefault();
                var assignments = $(this).closest('.document-scope-assignments');
                if (assignments.find('.scope-assignment-row').length > 1) {
                    $(this).closest('.scope-assignment-row').remove();
                } else {
                    $(this).closest('.scope-assignment-row').find('select').val('');
                }
            });
        });
    </script>


    <!--Toast Message-->
    <?php if (session()->getFlashdata('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Password and Confirm Password doesn't match.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'error-email') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Email already taken.",
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
    <?php elseif (session()->getFlashdata('msg') == 'error-scope') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Manager and validator require valid document scope assignments.",
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
                text: "New User Saved!",
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
                text: "User updated!",
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
                text: "User Deleted!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-activate') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "User Has Been activated!.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashdata('msg') == 'success-deactivate') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "User Has Been deactivated!.",
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