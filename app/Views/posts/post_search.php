<?= $this->extend('layouts/template-page'); ?>
<?= $this->section('content'); ?>

<section>
    <div class="bg-holder overlay" style="background-image:url(/assets/elixir/assets/img/background-2.jpg);background-position:center bottom;"></div>
    <div class="container">
        <div class="row pt-6">
            <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                <div class="overflow-hidden">
                    <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>Search Result</h1>
                    <p class="mb-0" data-zanim-xs='{"delay":0.1}'><?= esc($keyword); ?></p>
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
                    <div class="card h-100">
                        <a href="/p/<?= esc($post['post_slug']); ?>"><img class="card-img-top" src="/assets/backend/images/post/<?= esc($post['post_image']); ?>" alt="<?= esc($post['post_title']); ?>" /></a>
                        <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                            <div class="overflow-hidden">
                                <p class="text-500 mb-1" data-zanim-xs='{"delay":0}'><?= esc($post['category_name'] ?? '-'); ?></p>
                            </div>
                            <div class="overflow-hidden"><a href="/p/<?= esc($post['post_slug']); ?>">
                                    <h5 data-zanim-xs='{"delay":0.1}'><?= esc($post['post_title']); ?></h5>
                                </a></div>
                            <div class="overflow-hidden">
                                <p class="text-500" data-zanim-xs='{"delay":0.2}'>By <?= esc($post['user_name']); ?> | <time datetime="<?= esc($post['post_date']); ?>"><?= date('d M Y', strtotime($post['post_date'])); ?></time> | <?= (int) ($post['post_views'] ?? 0); ?> views</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-auto mx-auto mt-4">
                <nav class="mt-4" aria-label="Search pagination">
                    <?= $pager->links('search_posts', 'post_pagination'); ?>
                </nav>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
