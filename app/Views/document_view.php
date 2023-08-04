<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <section id="services" class="services">
        <div class="container">

        <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">
                                <!-- <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">Add New Member</button> -->
                                <div class="table-responsive">
                                    <table id="mytable" class="display table" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama dokumen</th>
                                                <th>Kategori</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $no = 0;
                                            foreach ($members as $row) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['member_name']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"><?= $row['member_link']; ?>
                                                    <td style="vertical-align: middle;">
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-success btn-md"><i class="bi bi-folder"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-primary btn-xs"><i class="bi bi-eye"></i></a>
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

        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection(); ?>