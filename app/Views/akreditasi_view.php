<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

    <!-- ======= Breadcrumbs ======= -->
    
    <!-- End Breadcrumbs -->

    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="preloader" id="preloader">
        <div class="loader">
          <div class="line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      </div>

      <!-- <section> begin ============================-->
      <section class="bg-100">

        <div class="container">
            
            <div class="row mt-3">
                <div class="col">
                    <h3 class="text-center fs-2 fs-md-3">Akreditasi Program Studi</h3>
                    <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
                </div>
                <div class="col-12">
                    <div class="bg-white px-3 mt-6 px-0 py-5 px-lg-5 rounded-3">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="mytable" class="display table table-striped table-hover" style="width: 100%; ">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nomor SK</th>
                                            <th>Nama Prodi</th>                    
                                            <th>Peringkat</th>
                                            <th>Kadaluarsa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table">
                                        <?php
                                        $no = 0;
                                        foreach ($documents as $row) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;"><?= $no; ?></td>
                                                <td style="vertical-align: middle;"><a href="<?= $row['aps_link']; ?>"><?= $row['no_sk']; ?></a></td>
                                                <td style="vertical-align: middle;"><?= $row['prodi_nama']; ?></td>
                                                <td style="vertical-align: middle;"><?= $row['peringkat']; ?></td>
                                                <td style="vertical-align: middle;"><?= $row['tgl_kadaluarsa']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
    </main>
    <!-- ============================================--> 

<?= $this->endSection(); ?>