<?= $this->extend('layouts/template-page'); ?>
<?= $this->section('content'); ?>

<?php
$programName = $program['prodi_nama'] ?? 'Program Studi';
$latestRecord = $latest ?? null;
$historyEntries = $history ?? [];

$formatDate = static function (?string $date): string {
    if ($date === null || trim($date) === '') {
        return '-';
    }

    try {
        return (new DateTimeImmutable($date))->format('d M Y');
    } catch (Exception $e) {
        return trim($date);
    }
};
?>

<main class="main" id="top">

    <?= $this->include('layouts/breadcrumbs'); ?>
    
  <section class="bg-100 py-5">
    <div class="container">
      <div class="row mt-3">
        <div class="col-12">
          <!-- <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/akreditasi">Akreditasi</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= esc($programName); ?></li>
            </ol>
          </nav> -->

          <div class="bg-white rounded-3 px-3 px-lg-5 py-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
              <div>
                <h3 class="mb-1"><?= esc($programName); ?></h3>
                <?php if (!empty($program['prodi_kode']) || !empty($program['prodi_strata'])): ?>
                  <p class="text-muted mb-0">
                    <?= esc($program['prodi_kode'] ?? ''); ?>
                    <?php if (!empty($program['prodi_kode']) && !empty($program['prodi_strata'])): ?>
                      •
                    <?php endif; ?>
                    <?= esc($program['prodi_strata'] ?? ''); ?>
                  </p>
                <?php endif; ?>
              </div>

              <a href="/akreditasi" class="btn btn-outline-primary rounded-pill">Kembali ke daftar akreditasi</a>
            </div>

            <?php if ($latestRecord): ?>
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <h5 class="mb-0">Akreditasi Terbaru</h5>
                    <span class="badge bg-success rounded-pill">Status: Aktif</span>
                  </div>

                  <div class="row g-3 align-items-end">
                        <div class="col-md-2">
                            <small class="text-uppercase text-muted">Peringkat</small>
                            <div class="fw-semibold"><?= esc($latestRecord['peringkat'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-uppercase text-muted">No. SK</small>
                            <div class="fw-semibold"><?= esc($latestRecord['no_sk'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-2">
                            <small class="text-uppercase text-muted">Tahun</small>
                            <div class="fw-semibold"><?= esc($latestRecord['thn_sk'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-2">
                            <small class="text-uppercase text-muted">Masa Berlaku</small>
                            <div class="fw-semibold"><?= esc($formatDate($latestRecord['tgl_kadaluarsa'] ?? null)); ?></div>
                        </div>
                        <?php $latestLink = trim((string) ($latestRecord['aps_link'] ?? '')); ?>
                        <?php if ($latestLink !== ''): ?>
                        <div class="col-md-2">
                        <a href="<?= esc($latestLink, 'attr'); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary rounded-pill" title="Preview akreditasi terbaru">
                            <i class="fas fa-eye me-1"></i> Preview
                        </a>
                        </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($historyEntries)): ?>
              <div class="mt-4">
                <h5 class="mb-3">Riwayat Akreditasi</h5>

                <?php foreach ($historyEntries as $item): ?>
                  <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                      <div class="row g-3 align-items-center">
                        <div class="col-md-2">
                          <small class="text-uppercase text-muted">Peringkat</small>
                          <div class="fw-semibold"><?= esc($item['peringkat'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-uppercase text-muted">No. SK</small>
                          <div class="fw-semibold"><?= esc($item['no_sk'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-2">
                          <small class="text-uppercase text-muted">Tahun</small>
                          <div class="fw-semibold"><?= esc($item['thn_sk'] ?? '-'); ?></div>
                        </div>
                        <div class="col-md-2">
                          <small class="text-uppercase text-muted">Kadaluarsa</small>
                          <div class="fw-semibold"><?= esc($formatDate($item['tgl_kadaluarsa'] ?? null)); ?></div>
                        </div>
                        <?php $itemLink = trim((string) ($item['aps_link'] ?? '')); ?>
                        <?php if ($itemLink !== ''): ?>
                        <div class="col-md-2">
                          <a href="<?= esc($itemLink, 'attr'); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary rounded-pill" title="Preview riwayat akreditasi">
                            <i class="fas fa-eye me-1"></i> Preview
                          </a>
                        </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="alert alert-info mb-0">Belum ada riwayat akreditasi untuk prodi ini.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?= $this->endSection(); ?>
