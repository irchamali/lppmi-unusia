<?php
// Partial filter berlapis: kategori, jenis, lingkup (+ fakultas/prodi jika relevan), tahun.
$hideCategoryFilter = $hideCategoryFilter ?? false;
$formAction = $formAction ?? base_url('documents');
$filters = $filters ?? [];
$fakultasList = $fakultasList ?? [];
$prodiList = $prodiList ?? [];
?>
<form action="<?= esc($formAction); ?>" method="get" class="row g-2 align-items-end mb-4" id="document-filter-form">
    <?php if (!$hideCategoryFilter) : ?>
    <div class="col-6 col-md-3 col-lg-2">
        <label class="form-label small text-muted mb-1">Kategori</label>
        <select name="category" class="form-select form-select-sm">
            <option value="">Semua Kategori</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= esc($category['category_slug']); ?>" <?= ($filters['category'] ?? null) === $category['category_slug'] ? 'selected' : ''; ?>><?= esc($category['category_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php endif; ?>
    <div class="col-6 col-md-3 col-lg-2">
        <label class="form-label small text-muted mb-1">Jenis</label>
        <select name="type" class="form-select form-select-sm">
            <option value="">Semua Jenis</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?= esc($type['type_slug']); ?>" <?= ($filters['type'] ?? null) === $type['type_slug'] ? 'selected' : ''; ?>><?= esc($type['type_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <label class="form-label small text-muted mb-1">Lingkup</label>
        <select name="scope" id="filter-scope" class="form-select form-select-sm">
            <option value="">Semua Lingkup</option>
            <?php foreach ($scopes as $scope) : ?>
                <option value="<?= esc($scope['scope_slug']); ?>" <?= ($filters['scope'] ?? null) === $scope['scope_slug'] ? 'selected' : ''; ?>><?= esc($scope['scope_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-6 col-md-3 col-lg-2 filter-fakultas" id="filter-fakultas-wrap" style="display: none;">
        <label class="form-label small text-muted mb-1">Fakultas</label>
        <select name="fakultas" id="filter-fakultas" class="form-select form-select-sm">
            <option value="">Semua Fakultas</option>
            <?php foreach ($fakultasList as $fak) : ?>
                <option value="<?= esc($fak['fak_slug']); ?>" <?= ($filters['fakultas'] ?? null) === $fak['fak_slug'] ? 'selected' : ''; ?>><?= esc($fak['fak_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-6 col-md-3 col-lg-2 filter-prodi" id="filter-prodi-wrap" style="display: none;">
        <label class="form-label small text-muted mb-1">Program Studi</label>
        <select name="prodi" id="filter-prodi" class="form-select form-select-sm">
            <option value="">Semua Prodi</option>
            <?php foreach ($prodiList as $prodi) : ?>
                <option value="<?= esc($prodi['prodi_slug']); ?>" data-fak-slug="<?= esc($prodi['fak_slug'] ?? ''); ?>" <?= ($filters['prodi'] ?? null) === $prodi['prodi_slug'] ? 'selected' : ''; ?>><?= esc($prodi['prodi_nama']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <label class="form-label small text-muted mb-1">Tahun</label>
        <select name="year" class="form-select form-select-sm">
            <option value="">Semua Tahun</option>
            <?php foreach ($years as $year) : ?>
                <option value="<?= esc((string) $year); ?>" <?= (string) ($filters['year'] ?? '') === (string) $year ? 'selected' : ''; ?>><?= esc((string) $year); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-12 col-lg-auto d-flex gap-2">
        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Filter</button>
        <a href="<?= esc($formAction); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset</a>
    </div>
</form>
<script>
(function () {
    var scopeSelect = document.getElementById('filter-scope');
    var fakultasWrap = document.getElementById('filter-fakultas-wrap');
    var prodiWrap = document.getElementById('filter-prodi-wrap');
    var fakultasSelect = document.getElementById('filter-fakultas');
    var prodiSelect = document.getElementById('filter-prodi');

    if (!scopeSelect || !fakultasSelect || !prodiSelect) {
        return;
    }

    function updateProdiOptions() {
        var fakSlug = fakultasSelect.value;
        Array.prototype.forEach.call(prodiSelect.options, function (opt) {
            if (!opt.value) {
                return;
            }
            opt.hidden = !!fakSlug && opt.dataset.fakSlug !== fakSlug;
        });
        if (prodiSelect.selectedOptions[0] && prodiSelect.selectedOptions[0].hidden) {
            prodiSelect.value = '';
        }
    }

    function updateVisibility() {
        var scopeSlug = scopeSelect.value || '';
        var requiresFakultas = scopeSlug.indexOf('fakultas') !== -1 || scopeSlug.indexOf('prodi') !== -1;
        var requiresProdi = scopeSlug.indexOf('prodi') !== -1;

        fakultasWrap.style.display = requiresFakultas ? '' : 'none';
        prodiWrap.style.display = requiresProdi ? '' : 'none';

        if (!requiresFakultas) {
            fakultasSelect.value = '';
        }
        if (!requiresProdi) {
            prodiSelect.value = '';
        }

        updateProdiOptions();
    }

    scopeSelect.addEventListener('change', updateVisibility);
    fakultasSelect.addEventListener('change', updateProdiOptions);
    updateVisibility();
})();
</script>
