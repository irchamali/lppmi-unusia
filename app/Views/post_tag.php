<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2 class="text-center"><?= $keyword; ?></h2>
            </header><br>

            <div class="row gy-4 posts-list">
                <?php foreach ($posts as $post) : ?>
                <div class="col-xl-4 col-md-6">
                    <article>

                        <div class="post-img">
                            <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="<?= $post['post_title']; ?>" class="img-fluid">
                        </div>

                        <!-- <p class="post-category"></p> -->

                        <h2 class="title">
                            <a href="/post/<?= $post['post_slug']; ?>"><?= $post['post_title']; ?></a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="/assets/backend/images/users/<?= $post['user_photo']; ?>" alt="<?= $post['post_title']; ?>"
                                class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author-list"><?= $post['user_name']; ?></p>
                                <p class="post-date">
                                    <time datetime="2022-01-01"><?= date('d M Y', strtotime($post['post_date'])); ?></time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->
                <?php endforeach; ?>
            </div><!-- End blog posts list -->
            
            <!-- End blog pagination -->

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>