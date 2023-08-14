<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="preloader" id="preloader">
        <div class="loader">
          <div class="line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      </div>
      <section class="py-0">
        <div class="swiper theme-slider min-vh-100" data-swiper='{"loop":true,"allowTouchMove":false,"autoplay":{"delay":5000},"effect":"fade","speed":800}'>
            <div class="swiper-wrapper">
            <?php foreach ($sliders as $slider) : ?>
                <div class="swiper-slide" data-zanim-timeline="{}">
                <div class="bg-holder" style="background-image:url(<?= 'assets/backend/images/slider/' . $slider['slider_image']; ?>);">
                </div>
                <!--/.bg-holder-->
                <div class="container">
                    <div class="row min-vh-100 py-8 align-items-center" data-inertia='{"weight":1.5}'>
                    <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                        <div class="overflow-hidden">
                        <h1 class="fs-4 fs-md-5 lh-1" data-zanim-xs='{"delay":0}'><?= $slider['slider_title']; ?></h1>
                        </div>
                        <div class="overflow-hidden">
                        <p class="text-primary pt-4 mb-5 fs-1 fs-md-2 lh-xs" data-zanim-xs='{"delay":0.1}'><?= $slider['slider_subtitle']; ?></p>
                        </div>
                        <div class="overflow-hidden">
                        <div data-zanim-xs='{"delay":0.2}'><a class="btn btn-primary me-3 mt-3" href="<?= $slider['slider_link']; ?>">Read more<span class="fas fa-chevron-right ms-2"></span></a><a class="btn btn-warning mt-3" href="/contact">Contact us<span class="fas fa-chevron-right ms-2"></span></a></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
            
          </div>
          <div class="swiper-nav">
            <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
            <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-white text-center">

        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-10 col-md-6">
              <h3 class="fs-2 fs-lg-3"><?= $site['site_name']; ?></h3>
              <p class="px-lg-4 mt-3"><?= $site['site_description']; ?></p>
              <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
            </div>
          </div>
          <div class="row mt-4 mt-md-5">
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="far fa-chart-bar"></span></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Dokumen</h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Solution for every business related problems, readily <br /> and skillfully.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="far fa-bell"></span></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Laporan</h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Calculate every possible risk in your business, take <br /> control over them.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="far fa-lightbulb"></span></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Data</h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Know the market before taking any step, reduce <br /> risks before you go.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-headset"></span></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Instrumen</h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Experience unparalleled service, from beginning <br /> to final construction.</p> -->
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

<?= $this->endSection(); ?>