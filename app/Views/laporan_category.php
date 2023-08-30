<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs1'); ?>
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
                                    <table id="mytable" class="display table table-striped table-hover" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun</th>
                                                <th>Nama Laporan</th>
                                                <th>Penyusun</th>                    
                                                <th>Kategori</th>
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
                                                    <td style="vertical-align: middle;"><?= $row['lap_year']; ?></td>
                                                    <td style="vertical-align: middle;"><a href="<?= $row['lap_link']; ?>"><?= $row['lap_name']; ?></a></td>
                                                    <td style="vertical-align: middle;"><?= $row['lap_unit']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['lapcategory_name']; ?></td>
                                                    <td style="vertical-align: middle;">
                                                        
                                                        <div class="btn-group">
                                                        <a class="btn-sm btn btn-outline-primary" href="<?= $row['lap_link']; ?>"><i class="fas fa-eye"></i></a>
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