<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">
    <div class="container position-relative">
        <div class="row gy-5" data-aos="fade-in">
            <div
                class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h2><?= $home['home_caption_1']; ?> <span><?= $about['about_name']; ?></h2>
                <p><?= $home['home_caption_2']; ?></p>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#about" class="btn-get-started">Get Started</a>
                    <a href="<?= $home['home_video']; ?>" class="glightbox btn-watch-video d-flex align-items-center"><i
                            class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <!-- <img src="/assets/frontend/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100"> -->
                <!-- <img src="/assets/frontend/img/<?= $about['about_image']; ?>" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100"> -->
            </div>
        </div>
    </div>

    <div class="icon-boxes position-relative">
        <div class="container position-relative">
            <div class="row gy-4 mt-5">

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-easel"></i></div>
                        <h4 class="title"><a href="" class="stretched-link">Dokumen</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-gem"></i></div>
                        <h4 class="title"><a href="" class="stretched-link">Laporan</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-geo-alt"></i></div>
                        <h4 class="title"><a href="" class="stretched-link">Data</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-command"></i></div>
                        <h4 class="title"><a href="" class="stretched-link">Pengaduan</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

            </div>
        </div>
    </div>

    </div>
</section>
<!-- End Hero Section -->

<main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2><?= $about['about_name']; ?></h2>
                <p><?= $site['site_description']; ?></p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <h3>Visi</h3>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus in maxime sequi consectetur sapiente expedita perferendis autem impedit temporibus asperiores, dolorem sunt dolorum nulla illo magni, dolores ipsa distinctio facere.</p> -->
                    <p><?= $about['about_description']; ?></p>
                    <div class="position-relative mt-4">
                        <img src="/assets/frontend/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                    </div>
                    <!-- <img src="/assets/frontend/img/about.jpg" class="img-fluid rounded-4 mb-4" alt=""> -->
                </div>
                <div class="col-lg-6">
                    <div class="content ps-0 ps-lg-5">
                        <h3>
                            Misi
                        </h3>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> Membantu pimpinan Universitas Nahdlatul Ulama Indonesia dalam mewujudkan Good University Governance melalui pengawasan dan penjaminan mutu bidang akademik dan nonakademik.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Memastikan pelaksanaan sistem mutu dan tata kelola yang mengandung prinsip profesional, independen, kredibel, objektif, berintegritas, dan meningkatkan budaya kolaborasi.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Membantu pimpinan dalam menyusun peta risiko (manajemen risiko) bidang akademik dan nonakademik guna perbaikan berkelanjutan.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Melakukan pengawasan tata kelola bidang pengelolaan keuangan (perencanaan, pelaksanaan, dan pertanggungjawaban), pengelolaan perencanaan dan sarana prasarana, pengelolaan sumber daya manusia, pengelolaan kemahasiswaan, serta kerja sama.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Melakukan reviu, evaluasi, pemantauan, dan bentuk pengawasan lainnya atas kegiatan objek pengawasan dan pemeriksaan kinerja akademik dan nonakademik universitas.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Memberikan rekomendasi perbaikan dalam rangka meningkatkan mutu dan tata kelola serta kinerja akademik dan nonakademik universitas.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Menjamin dan mendampingi proses sistem penjaminan mutu akademik dan nonakademik melalui siklus Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan (PPEPP) satu kali dalam satu tahun akademik.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Melaksanakan kegiatan peningkatan kapasitas personel LPPMI UNUSIA.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Melakukan kerja sama dan kolaborasi dengan lembaga terkait yang berasal dari perguruan tinggi lain ataupun lembaga lain yang terkait guna inovasi dan meningkatkan kinerja LPPMI UNUSIA serta mutu UNUSIA secara keseluruhan.</li>
                        </ul>

                        <!-- <div class="position-relative mt-4">
                            <img src="/assets/frontend/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-out">

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-1.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-2.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-3.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-4.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-5.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-6.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-7.png" class="img-fluid"
                            alt=""></div>
                    <div class="swiper-slide"><img src="/assets/frontend/img/clients/client-8.png" class="img-fluid"
                            alt=""></div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Clients Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6">
                    <img src="/assets/frontend/img/stats-img.svg" alt="" class="img-fluid">
                </div>

                <div class="col-lg-6">

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Happy Clients</strong> consequuntur quae diredo para mesta</p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Projects</strong> adipisci atque cum quia aut</p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="453" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
        <div class="container text-center" data-aos="zoom-out">
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.</p>
            <a class="cta-btn" href="#">Call To Action</a>
        </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Testimonials</h2>
                <p>Voluptatem quibusdam ut ullam perferendis repellat non ut consequuntur est eveniet deleniti
                    fignissimos eos quam</p>
            </div>

            <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <div class="d-flex align-items-center">
                                    <img src="<?= 'assets/backend/images/testi/' . $testimonial['testimonial_image']; ?>"
                                        class="testimonial-img flex-shrink-0" alt="">
                                    <div>
                                        <h3><?= $testimonial['testimonial_name']; ?></h3>
                                        <h4><?= $testimonial['testimonial_angkatan']; ?></h4>
                                        
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->
                <?php endforeach; ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Recent Blog Posts</h2>
                <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto
                    accusamus fugit aut qui distinctio</p>
            </div>

            <div class="row gy-4">

                <div class="col-xl-4 col-md-6">
                    <article>

                        <div class="post-img">
                            <img src="/assets/frontend/img/blog/blog-1.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Politics</p>

                        <h2 class="title">
                            <a href="blog-details.html">Dolorum optio tempore voluptas dignissimos</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="/assets/frontend/img/blog/blog-author.jpg" alt=""
                                class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Maria Doe</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jan 1, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6">
                    <article>

                        <div class="post-img">
                            <img src="/assets/frontend/img/blog/blog-2.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Sports</p>

                        <h2 class="title">
                            <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="/assets/frontend/img/blog/blog-author-2.jpg" alt=""
                                class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Allisa Mayer</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jun 5, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6">
                    <article>

                        <div class="post-img">
                            <img src="/assets/frontend/img/blog/blog-3.jpg" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">Entertainment</p>

                        <h2 class="title">
                            <a href="blog-details.html">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="/assets/frontend/img/blog/blog-author-3.jpg" alt=""
                                class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">Mark Dower</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01">Jun 22, 2022</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div><!-- End post list item -->

            </div><!-- End recent posts list -->

        </div>
    </section><!-- End Recent Blog Posts Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>