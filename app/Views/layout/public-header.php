<?php $publicLayout = $publicLayout ?? 'elixir'; ?>

<?php if ($publicLayout === 'classic') : ?>
<?= $this->include('layout/header'); ?>
<?php else : ?>
<?= $this->include('layout/header1'); ?>
<?php endif; ?>