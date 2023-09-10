<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span><?= $about['about_name']; ?></span>
                </a>
                <p><?= $site['site_description']; ?></p>
                <div class="social-links d-flex mt-4">
                    <a href="<?= $site['site_twitter']; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="<?= $site['site_facebook']; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="<?= $site['site_instagram']; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="<?= $site['site_linkedin']; ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/akreditasi">Akreditasi</a></li>
                    <li><a href="/document">Dokumen</a></li>
                    <li><a href="/laporan">Laporan</a></li>
                    <!-- <li><a href="#">Privacy policy</a></li> -->
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="/ami">Formulir</a></li>
                    <li><a href="/team">SDM</a></li>
                    <li><a href="/pengaduan">Pengaduan</a></li>
                    <li><a href="/gallery">Galeri</a></li>
                    <!-- <li><a href="#">Graphic Design</a></li> -->
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Sekretariat</h4>
                <p>
                    <?= $site['site_address']; ?><br>
                </p>

            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="copyright">
            &copy; Copyright <strong><span>UNUSIA</span></strong> <?= date('Y') ?>
        </div>
    </div>

</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="/assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/frontend/vendor/aos/aos.js"></script>
<script src="/assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/frontend/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/frontend/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/assets/frontend/js/main.js"></script>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
</script>

</body>

</html>