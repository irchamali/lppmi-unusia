<?= $this->extend('layouts/template-page'); ?>
<?= $this->section('content'); ?>

<?php
$documentDate = !empty($document['document_date']) ? date('d M Y', strtotime((string) $document['document_date'])) : '-';
$ppeppLabels = [
    'penetapan' => 'Penetapan',
    'pelaksanaan' => 'Pelaksanaan',
    'evaluasi' => 'Evaluasi',
    'pengendalian' => 'Pengendalian',
    'peningkatan' => 'Peningkatan',
];
$ppeppLabel = $ppeppLabels[$document['ppepp_stage'] ?? ''] ?? null;
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
              <li class="mb-2"><strong>Judul</strong><br><?= esc($document['document_title']); ?></li>
              <li class="mb-2"><strong>Nomor</strong><br><?= esc($document['document_number']); ?></li>
              <li class="mb-2"><strong>Tanggal</strong><br><?= esc($documentDate); ?></li>
              <li class="mb-2"><strong>Kategori</strong><br><?= esc($document['category_name'] ?? '-'); ?></li>
              <li class="mb-2"><strong>Jenis</strong><br><?= esc($document['type_name'] ?? '-'); ?></li>
              <li class="mb-2"><strong>Lingkup</strong><br><?= esc($document['scope_name'] ?? '-'); ?></li>
              <?php if (!empty($document['fak_name'])) : ?>
                <li class="mb-2"><strong>Fakultas</strong><br><?= esc($document['fak_name']); ?></li>
              <?php endif; ?>
              <?php if (!empty($document['prodi_nama'])) : ?>
                <li class="mb-2"><strong>Program Studi</strong><br><?= esc($document['prodi_nama']); ?></li>
              <?php endif; ?>
              <?php if ($ppeppLabel !== null) : ?>
                <li class="mb-2"><strong>Tahap PPEPP</strong><br><?= esc($ppeppLabel); ?></li>
              <?php endif; ?>
              <?php if (!empty($document['document_description'])) : ?>
                <li class="mb-2"><strong>Deskripsi</strong><br><?= nl2br(esc($document['document_description'])); ?></li>
              <?php endif; ?>
            </ul>

            <div class="d-grid gap-2">
              <a href="<?= esc($preview_link); ?>" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill">Buka Preview</a>
              <a href="<?= esc($download_link); ?>" target="_blank" rel="noopener" class="btn btn-primary rounded-pill">Download Dokumen</a>
              <a href="<?= base_url('documents'); ?>" class="btn btn-link text-decoration-none">Kembali ke Daftar Dokumen</a>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="bg-white rounded-3 p-4 mb-4">
            <h5 class="mb-3">Preview Dokumen</h5>
            <p class="mb-3 text-700">Jika preview tidak tampil, gunakan tombol Buka Preview atau Download Dokumen.</p>
            <div class="ratio ratio-16x9" style="min-height: 70vh;">
              <iframe src="<?= esc($preview_link); ?>" title="Preview <?= esc($document['document_title']); ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="bg-white rounded-3 p-4">
            <h5 class="mb-3">Dokumen Terkait</h5>
            <?php if (empty($related_documents)) : ?>
              <p class="text-muted small mb-0">Belum ada dokumen terkait yang tertaut untuk dokumen ini.</p>
            <?php else : ?>
              <?php foreach ($related_documents as $relationName => $items) : ?>
                <div class="mb-3">
                  <h6 class="text-uppercase text-muted small mb-2"><?= esc($relationName); ?></h6>
                  <ul class="list-unstyled mb-0">
                    <?php foreach ($items as $related) : ?>
                      <li class="mb-2">
                        <a href="<?= base_url('d/' . $related['docs_slug']); ?>"><?= esc($related['document_title']); ?></a>
                        <?php if (!empty($related['relation_notes'])) : ?>
                          <!-- <span class="text-muted small d-block"><?= esc($related['relation_notes']); ?></span> -->
                        <?php endif; ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?= $this->endSection(); ?>
