<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs2'); ?>
    <!-- End Breadcrumbs -->

    <section id="services" class="services">
        <div class="container">

        <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="display table table-striped table-hover" style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun</th>
                                                <th>Nama Dokumen</th>
                                                <th>Pembuat</th>                    
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
                                                    <td style="vertical-align: middle;"><?= $row['docs_year']; ?></td>
                                                    <td style="vertical-align: middle;"><a href="<?= $row['docs_link']; ?>"><?= $row['docs_name']; ?></a></td>
                                                    <td style="vertical-align: middle;"><?= $row['docs_unit']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $row['docscategory_name']; ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="btn-group">
                                                        <a class="btn-sm btn btn-outline-primary" href="<?= $row['docs_link']; ?>"><i class="fas fa-eye"></i></a>
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