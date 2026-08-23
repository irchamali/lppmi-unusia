<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<section>
  <div class="bg-holder overlay" style="background-image:url(/assets/elixir/assets/img/background-2.jpg);background-position:center bottom;"></div>
  <div class="container">
    <div class="row pt-6">
      <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
        <div class="overflow-hidden">
          <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'><?= esc($post['post_title']); ?></h1>
          <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
            <ol class="breadcrumb fs-1 ps-0 fw-bold">
              <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
              <li class="breadcrumb-item"><a class="text-white" href="/posts">Berita</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="card mb-4">
          <img class="card-img-top" src="/assets/backend/images/post/<?= esc($post['post_image']); ?>" alt="<?= esc($post['post_title']); ?>" />
          <div class="card-body p-4 p-lg-5">
            <p class="text-500 mb-2">
              <a href="/authors/<?= (int) $post['post_user_id']; ?>"><?= esc($post['user_name']); ?></a>
              | <time datetime="<?= esc($post['post_date']); ?>"><?= date('d M Y', strtotime($post['post_date'])); ?></time>
              | <?= (int) ($post['post_views'] ?? 0); ?> views
            </p>
            <h4 class="mb-4"><?= esc($post['post_title']); ?></h4>

            <div class="mb-4">
              <?= $post['post_contents']; ?>
            </div>

            <div class="d-flex flex-wrap gap-2 mb-2">
              <?php if (!empty($post['category_slug'])) : ?>
                <a class="btn btn-sm btn-outline-primary" href="/categories/<?= esc($post['category_slug']); ?>">Category: <?= esc($post['category_name'] ?? $post['category_slug']); ?></a>
              <?php endif; ?>
              <?php foreach (($post_tags ?? []) as $tag) : ?>
                <?php $cleanTag = trim((string) $tag); ?>
                <?php if ($cleanTag !== '') : ?>
                  <a class="btn btn-sm btn-outline-primary" href="/tags/<?= esc($cleanTag); ?>">#<?= esc($cleanTag); ?></a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-body p-4 p-lg-5">
            <h5 class="mb-0">Komentar dinonaktifkan untuk menjaga keamanan konten.</h5>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mt-5 mt-lg-0">
        <div class="card mb-4">
          <div class="card-body p-4 text-center">
            <img class="rounded-circle mb-3" src="/assets/backend/images/users/<?= esc($post['user_photo']); ?>" alt="Author" width="96" height="96" />
            <h5 class="text-capitalize mb-1"><?= esc($post['user_name']); ?></h5>
            <p class="mb-0 text-500">Artikel dari kontributor LPPMI UNUSIA.</p>
          </div>
        </div>

        <div class="mb-4">
          <h5 class="mb-3">Related Articles</h5>
          <?php foreach (($related_post ?? []) as $related) : ?>
            <div class="card mb-3">
              <a href="/p/<?= esc($related['post_slug']); ?>"><img class="card-img-top" src="/assets/backend/images/post/<?= esc($related['post_image']); ?>" alt="<?= esc($related['post_title']); ?>" /></a>
              <div class="card-body">
                <h6 class="mb-1"><a href="/p/<?= esc($related['post_slug']); ?>"><?= esc($related['post_title']); ?></a></h6>
                <p class="text-500 fs--1 mb-0">By <?= esc($related['user_name']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="card">
          <div class="card-body p-4">
            <h5>Tags</h5>
            <ul class="nav tags mt-3 fs--1">
              <?php foreach (($tags ?? []) as $tag) : ?>
                <li><a class="btn btn-sm btn-outline-primary m-1 p-2" href="/tags/<?= esc($tag['tag_name']); ?>"><?= esc($tag['tag_name']); ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>
