<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<section>
    <div class="bg-holder overlay" style="background-image:url(/assets/elixir/assets/img/background-2.jpg);background-position:center bottom;"></div>
    <div class="container">
        <div class="row pt-6">
            <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                <div class="overflow-hidden">
                    <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>News Room</h1>
                    <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
                        <ol class="breadcrumb fs-1 ps-0 fw-bold">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-100">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100"><a href="/p/<?= $post['post_slug']; ?>"><img class="card-img-top" src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="<?= esc($post['post_title']); ?>" /></a>
                        <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                            <div class="overflow-hidden"><a href="/categories/<?= $post['category_slug'] ?? ''; ?>">
                                    <p class="text-500 mb-1" data-zanim-xs='{"delay":0}'><?= esc($post['category_name']); ?></p>
                                </a></div>
                            <div class="overflow-hidden"><a href="/p/<?= $post['post_slug']; ?>">
                                    <h5 data-zanim-xs='{"delay":0.1}'><?= esc($post['post_title']); ?></h5>
                                </a></div>
                            <div class="overflow-hidden">
                                <p class="text-500" data-zanim-xs='{"delay":0.2}'>By <?= esc($post['user_name']); ?> | <time datetime="<?= esc($post['post_date']); ?>"><?= date('d M Y', strtotime($post['post_date'])); ?></time> | <?= (int) $post['post_views']; ?> views</p>
                            </div>
                            <div class="overflow-hidden">
                                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="/p/<?= $post['post_slug']; ?>">Learn More
                                        <div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-auto mx-auto mt-4">
                <nav class="mt-4" aria-label="Page navigation">
                    <?= $pager->links('posts', 'post_pagination'); ?>
                </nav>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>