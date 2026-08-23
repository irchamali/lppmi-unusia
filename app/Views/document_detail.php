<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<?php
$createdAt = !empty($document['docs_created_at']) ? date('d M Y H:i', strtotime((string) $document['docs_created_at'])) : '-';
$updatedAt = !empty($document['docs_updated_at']) ? date('d M Y H:i', strtotime((string) $document['docs_updated_at'])) : '-';
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
      <div class="row mt-6 mb-6">
        <div class="col">
          <h3 class="text-center fs-2 fs-md-3">Detail Dokumen</h3>
          <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <div class="bg-white rounded-3 p-4 h-100 sticky-sidebar">
            <h5 class="text-uppercase mb-3">Informasi Dokumen</h5>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><strong>Nama</strong><br><?= esc($document['docs_name']); ?></li>
              <li class="mb-2"><strong>Pembuat</strong><br><?= esc($document['docs_unit']); ?></li>
              <li class="mb-2"><strong>No. SK</strong><br><?= esc($document['docs_sk']); ?></li>
              <li class="mb-2"><strong>Tahun</strong><br><?= esc($document['docs_year']); ?></li>
              <li class="mb-2"><strong>Kategori</strong><br><?= esc($document['docscategory_name'] ?? '-'); ?></li>
              <li class="mb-2"><strong>Dibuat</strong><br><?= esc($createdAt); ?></li>
              <li class="mb-2"><strong>Diperbarui</strong><br><?= esc($updatedAt); ?></li>
            </ul>

            <div class="d-grid gap-2">
              <a href="<?= esc($preview_link); ?>" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill">Buka Preview</a>
              <a href="<?= esc($download_link); ?>" target="_blank" rel="noopener" class="btn btn-primary rounded-pill">Download Dokumen</a>
              <a href="<?= base_url('documents'); ?>" class="btn btn-link text-decoration-none">Kembali ke Daftar Dokumen</a>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="bg-white rounded-3 p-4">
            <h5 class="mb-3">Preview Dokumen</h5>
            <p class="mb-3 text-700">Jika preview tidak tampil, gunakan tombol Buka Preview atau Download Dokumen.</p>
            <div class="ratio ratio-16x9" style="min-height: 70vh;">
              <iframe src="<?= esc($preview_link); ?>" title="Preview <?= esc($document['docs_name']); ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?= $this->endSection(); ?>
