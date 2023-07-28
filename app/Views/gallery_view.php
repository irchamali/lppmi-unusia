<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

          <div>
            <ul class="portfolio-flters">
              <!-- <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-product">Product</li>
              <li data-filter=".filter-branding">Branding</li>
              <li data-filter=".filter-books">Books</li> -->
            </ul><!-- End Portfolio Filters -->
          </div>

          <div class="row gy-4 portfolio-container">
          <?php foreach ($posts as $post) : ?>
            <div class="col-xl-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="/assets/backend/images/post/<?= $post['post_image']; ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="/assets/backend/images/post/<?= $post['post_image']; ?>" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="/post/<?= $post['post_slug']; ?>" title="More Details"><?= $post['post_title']; ?></a></h4>
                  <!-- <p>Lorem ipsum, dolor sit amet consectetur</p> -->
                </div>
              </div>
            </div><!-- End Portfolio Item -->
            <?php endforeach; ?>

          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section>
    <!-- End Portfolio Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>