<?php $publicLayout = $publicLayout ?? 'elixir'; ?>

<?php if ($publicLayout === 'classic') : ?>
<?= $this->include('layout/footer'); ?>
<?php else : ?>
<?= $this->include('layout/footer1'); ?>
<?php endif; ?>