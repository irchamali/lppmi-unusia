<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

    <!-- ======= Breadcrumbs ======= -->
    
    <!-- End Breadcrumbs -->

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

      <!-- <section> begin ============================-->
      <section class="bg-100 mt-2">

        <div class="container">
            <div class="swiper theme-slider" data-swiper='{"autoplay":true,"spaceBetween":30,"loop":true,"slidesPerView":1,"breakpoints":{"670":{"slidesPerView":2},"1200":{"slidesPerView":3}}}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Strategy Map</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-check-circle"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Milestone</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-arrow-alt-circle-right"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Fungsi dan Tugas</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-check-circle"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Struktur Organisasi</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-arrow-alt-circle-right"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Alur Kerja</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-check-circle"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body px-5">
                        <h5 class="mb-3">Monitoring dan Evaluasi</h5>
                            <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="#">
                                <span class="btn-icon-wrapper">
                                    <span class="far fa-arrow-alt-circle-right"></span>
                                </span>Read more&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-nav">
                <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
                <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
            </div>
            </div>
            
          <div class="row mt-6">
            <div class="col">
              <h3 class="text-center fs-2 fs-md-3"><?= $about['about_name']; ?></h3>
              <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
            </div>
            <div class="col-12">
              <div class="bg-white px-3 mt-6 px-0 py-5 px-lg-5 rounded-3">
                <h5>Profil Singkat</h5>
                <p class="mt-3"><?= $about['about_description']; ?></p><br>
                <h5>Visi</h5>
                <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                  <h5 class="fw-medium ms-3 mb-0"><?= $about['about_visi']; ?></h5>
                </blockquote><br>
                <h5>Misi</h5>
                <p class="column-lg-6 mb-1">
                1. Mewujudkan Good University Governance melalui pengawasan dan penjaminan mutu bidang akademik dan nonakademik.<br> 
                2. Memastikan pelaksanaan sistem mutu dan tata kelola yang mengandung prinsip profesional, independen, objektif, kredibel, berintegritas, dan meningkatkan budaya kolaborasi.<br>
                3. Menyusun peta risiko (manajemen risiko) bidang akademik dan nonakademik guna perbaikan berkelanjutan.<br>
                4. Melakukan pengawasan tata kelola bidang pengelolaan keuangan, perencanaan dan sarana prasarana, sumber daya manusia, kemahasiswaan, kerja sama, serta hal terkait nonakademik lainnya.<br>
                5. Menjamin dan mendampingi proses sistem penjaminan mutu akademik dan nonakademik melalui siklus Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan (PPEPP) satu kali dalam satu tahun akademik.<br>
                6. Melakukan reviu, evaluasi, pemantauan, dan bentuk pengawasan lainnya atas kegiatan objek pengawasan dan pemeriksaan kinerja akademik dan nonakademik universitas.<br>
                7. Memberikan rekomendasi perbaikan dalam rangka meningkatkan mutu dan tata kelola serta kinerja akademik dan nonakademik universitas.<br>
                8. Melaksanakan kegiatan peningkatan kapasitas personel LPPMI UNUSIA.<br> 
                9. Bekerja sama dan berkolaborasi dengan lembaga terkait yang berasal dari perguruan tinggi lain ataupun lembaga lain yang terkait guna meningkatkan inovasi dan kinerja LPPMI UNUSIA serta mutu UNUSIA secara keseluruhan.
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      

<?= $this->endSection(); ?>