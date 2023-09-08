<div class="swiper theme-slider" data-swiper='{"autoplay":true,"spaceBetween":30,"loop":true,"slidesPerView":1,"breakpoints":{"670":{"slidesPerView":2},"1200":{"slidesPerView":3}}}'>
                <div class="swiper-wrapper">
                <?php foreach ($daftils as $daftil) : ?>
                    <div class="swiper-slide col-lg-4 mb-4 mb-lg-0">
                        <div class="card h-100">
                            <div class="card-body px-5">
                            <h5 class="mb-3"><?= $daftil['prodi_nama']; ?></h5>
                                <a class="btn-sm btn-outline-primary btn-icon-right btn btn-icon rounded-pill" href="<?= $daftil['prodi_link']; ?>">
                                    <span class="btn-icon-wrapper">
                                        <span class="far fa-check-circle"></span>
                                    </span>Read more&nbsp;&nbsp;
                                </a>
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