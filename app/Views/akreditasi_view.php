<?= $this->extend('layouts/template-page'); ?>
<?= $this->section('content'); ?>

<?php
$today = new DateTimeImmutable('today');

$formatDuration = static function (DateInterval $diff): string {
    return $diff->y . ' tahun ' . $diff->m . ' bulan ' . $diff->d . ' hari';
};
?>

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
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                <h5 class="mb-0">Filter Program Studi</h5>
                                <span class="text-muted small"><?= count($documents); ?> prodi terdaftar</span>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($documents as $row): ?>
                                    <a href="/akreditasi/<?= esc($row['prodi_slug'] ?? $row['prodi_id'], 'url'); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <?= esc($row['prodi_nama']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

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
                                                <th>Masa Berlaku</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php
                                            $no = 0;
                                            foreach ($documents as $row) :
                                                $no++;

                                                $validityText = '-';
                                                $validityClass = 'bg-secondary';
                                                $expiredDateText = trim((string) ($row['tgl_kadaluarsa'] ?? ''));

                                                if ($expiredDateText !== '') {
                                                    try {
                                                        $expiredDate = new DateTimeImmutable($expiredDateText);
                                                        $diff = $today->diff($expiredDate);
                                                        $days = (int) $diff->format('%a');
                                                        $durationText = $formatDuration($diff);

                                                        if ($diff->invert === 1) {
                                                            $validityText = 'Kadaluarsa sejak ' . $durationText;
                                                            $validityClass = 'bg-danger';
                                                        } elseif ($days <= 90) {
                                                            $validityText = 'Sisa ' . $durationText;
                                                            $validityClass = 'bg-warning text-dark';
                                                        } else {
                                                            $validityText = 'Aktif (' . $durationText . ' lagi)';
                                                            $validityClass = 'bg-success';
                                                        }
                                                    } catch (Exception $e) {
                                                        $validityText = 'Format tanggal tidak valid';
                                                        $validityClass = 'bg-secondary';
                                                    }
                                                }
                                            ?>
                                                <tr>
                                                    <td style="vertical-align: middle; text-align: center;"><?= $no; ?></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['no_sk']); ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <a href="/akreditasi/<?= esc($row['prodi_slug'] ?? $row['prodi_id'], 'url'); ?>"><?= esc($row['prodi_nama']); ?></a>
                                                    </td>
                                                    <td style="vertical-align: middle;"><?= esc($row['peringkat']); ?></td>
                                                    <td style="vertical-align: middle;"><?= esc($row['tgl_kadaluarsa']); ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <span class="badge rounded-pill <?= esc($validityClass); ?>"><?= esc($validityText); ?></span>
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