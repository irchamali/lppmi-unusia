<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<?php
$createdAt = !empty($report['lap_created_at']) ? date('d M Y H:i', strtotime((string) $report['lap_created_at'])) : '-';
$updatedAt = !empty($report['lap_updated_at']) ? date('d M Y H:i', strtotime((string) $report['lap_updated_at'])) : '-';
?>

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

  <section class="bg-100 py-5">
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="text-center fs-2 fs-md-3">Detail Laporan</h3>
          <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <div class="bg-white rounded-3 p-4 h-100 sticky-sidebar">
            <h5 class="text-uppercase mb-3">Informasi Laporan</h5>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><strong>Nama</strong><br><?= esc($report['lap_name']); ?></li>
              <li class="mb-2"><strong>Penyusun</strong><br><?= esc($report['lap_unit']); ?></li>
              <li class="mb-2"><strong>Tahun</strong><br><?= esc($report['lap_year']); ?></li>
              <li class="mb-2"><strong>Kategori</strong><br><?= esc($report['lapcategory_name'] ?? '-'); ?></li>
              <li class="mb-2"><strong>Dibuat</strong><br><?= esc($createdAt); ?></li>
              <li class="mb-2"><strong>Diperbarui</strong><br><?= esc($updatedAt); ?></li>
            </ul>

            <div class="d-grid gap-2">
              <a href="<?= esc($preview_link); ?>" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill">Buka Pratinjau</a>
              <a href="<?= esc($download_link); ?>" target="_blank" rel="noopener" class="btn btn-primary rounded-pill">Unduh Laporan</a>
              <a href="<?= base_url('reports'); ?>" class="btn btn-link text-decoration-none">Kembali ke Daftar Laporan</a>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="bg-white rounded-3 p-4">
            <h5 class="mb-3">Pratinjau</h5>
            <p class="mb-3 text-700">Jika pratinjau tidak tampil, gunakan tombol pratinjau atau unduh di atas.</p>
            <div class="ratio ratio-16x9" style="min-height: 70vh;">
              <iframe src="<?= esc($preview_link); ?>" title="Pratinjau <?= esc($report['lap_name']); ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?= $this->endSection(); ?>
