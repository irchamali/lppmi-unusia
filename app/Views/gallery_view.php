<?= $this->extend('layouts/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layouts/breadcrumbs'); ?>
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
          

          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section>
    <!-- End Portfolio Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>