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
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><a href="/document"><span class="far fa-chart-bar"></span></a></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'><a href="/document">Dokumen</a></h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Solution for every business related problems, readily <br /> and skillfully.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><a href="/laporan"><span class="far fa-bell"></span></a></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'><a href="/laporan">Laporan</a></h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Calculate every possible risk in your business, take <br /> control over them.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><a href="/akreditasi"><span class="far fa-lightbulb"></span></a></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'><a href="/akreditasi">Akreditasi</a></h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Know the market before taking any step, reduce <br /> risks before you go.</p> -->
            </div>
            <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><a href="/"><span class="fas fa-headset"></span></a></div>
              <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'><a href="/ami">Instrumen</a></h5>
              <!-- <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Experience unparalleled service, from beginning <br /> to final construction.</p> -->
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      
      <!-- === logo mitra =========================================-->
      <div class="bg-200 py-6">
          <div class="container">
              <div class="swiper theme-slider" data-swiper='{"autoplay":true,"spaceBetween":30,"loop":true,"slidesPerView":3,"breakpoints":{"670":{"slidesPerView":4},"1200":{"slidesPerView":5}}}'>
                  <!-- <div class="swiper-wrapper" data-zanim-timeline="{}" data-zanim-trigger="scroll"> -->
                  <div class="swiper-wrapper">
                    <?php foreach ($members as $member) : ?>
                      <div class="swiper-slide col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="<?= 'assets/backend/images/member/' . $member['member_image']; ?>" alt="partnerco" data-zanim-xs="{}" /></div>
                    <?php endforeach; ?>
                  </div>
                </div>
          </div>
      </div>


      <!-- <section> rilis berita ============================-->
      <section class="bg-100">

        <div class="container">
          <div class="text-center mb-6">
            <h3 class="fs-2 fs-md-3">Berita Terbaru</h3>
            <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
          </div>
          <div class="row g-4">
          <?php foreach ($latest_posts as $post) : ?>
            <div class="col-md-6 col-lg-4">
              <div class="card"><a href="/post/<?= $post['post_slug']; ?>"><img class="card-img-top" src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="<?= $post['post_title']; ?>" /></a>
                <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                  <div class="overflow-hidden"><a href="news/news.html">
                      <h5 data-zanim-xs='{"delay":0}'><a href="/post/<?= $post['post_slug']; ?>"><?= $post['post_title']; ?></a></h5>
                    </a></div>
                  <div class="overflow-hidden">
                    <p class="text-500" data-zanim-xs='{"delay":0.1}'><?= $post['user_name']; ?> | <time datetime="2022-01-01"><?= date('d M Y', strtotime($post['post_date'])); ?></time></p> 
                  </div>
                  <div class="overflow-hidden">
                    <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="/post/<?= $post['post_slug']; ?>">Learn More
                        <div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div>
                      </a></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          </div>
            <div class="blog-pagination">
                <ul class="justify-content-center">
                    <!-- <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li> -->
                </ul>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->

<?= $this->endSection(); ?>