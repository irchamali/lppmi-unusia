<?= $this->extend('layouts/template-page'); ?>
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
            
            <div class="row mt-4">
                <div class="col">
                    <h3 class="text-center fs-2 fs-md-3">Pusat Dokumen</h3>
                    <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
                </div>
                <div class="col-12">
                    <div class="bg-white px-3 mt-6 px-0 py-5 px-lg-5 rounded-3">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <?= $this->include('documents/_filter_form'); ?>

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                <span class="text-muted small"><?= count($documents); ?> dokumen ditemukan</span>
                            </div>

                            <div class="table-responsive">
                                <table id="mytable" class="display table table-striped table-hover" style="width: 100%; ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Judul Dokumen</th>
                                            <th>Kategori</th>
                                            <th>Jenis</th>
                                            <th>Lingkup</th>
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
                                                <td style="vertical-align: middle;"><?= !empty($row['document_date']) ? date('d M Y', strtotime((string) $row['document_date'])) : '-'; ?></td>
                                                <td style="vertical-align: middle;"><a href="<?= base_url('d/' . $row['docs_slug']); ?>"><?= esc($row['document_title']); ?></a></td>
                                                <td style="vertical-align: middle;"><?= esc($row['category_name'] ?? '-'); ?></td>
                                                <td style="vertical-align: middle;"><?= esc($row['type_name'] ?? '-'); ?></td>
                                                <td style="vertical-align: middle;"><?= esc($row['scope_name'] ?? '-'); ?></td>
                                                <td style="vertical-align: middle;">
                                                    <div class="btn-group">
                                                        <a class="btn-sm btn btn-outline-primary" href="<?= base_url('d/' . $row['docs_slug']); ?>"><i class="fas fa-eye"></i></a>
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
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
    </main>
    <!-- ============================================--> 

<?= $this->endSection(); ?>