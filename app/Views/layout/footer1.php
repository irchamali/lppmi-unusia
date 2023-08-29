<!-- <section> begin ============================-->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i>Cek Atas</a>
    <!-- <a class="scroll-top" href="#">Up</a> -->

    <section style="background-color: #3D4C6F">

      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="bg-primary text-white p-5 p-lg-6 rounded-3">
              <h4 class="text-white fs-1 fs-lg-2 mb-1"><?= $site['site_name']; ?></h4><br>
              <ul class="list-unstyled">
                <li class="mb-0"><a class="text-decoration-none d-flex align-items-center" href="#"> <span class="brand-icon me-3"><span class="fas fa-star"></span></span>
                  <p class="fs-0 text-white mb-0 d-inline-block"><?= $site['site_description']; ?></p>
                </a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="row">
              <div class="col-6 col-lg-4 text-white ms-lg-auto">
                <ul class="list-unstyled">
                  <li class="mb-3"><a class="text-white" href="/about">Tentang</a></li>
                  <li class="mb-3"><a class="text-white" href="/document">Dokumen</a></li>
                  <li class="mb-3"><a class="text-white" href="/laporan">Laporan</a></li>
                  <li class="mb-3"><a class="text-white" href="/data">Data</a></li>
                  <li class="mb-3"><a class="text-white" href="/pengaduan">Pengaduan</a></li>
                </ul>
              </div>
              <div class="col-6 col-sm-5 ms-sm-auto">
                <ul class="list-unstyled">
                  <li class="mb-2"><a class="text-decoration-none d-flex align-items-center" href="<?= $site['site_linkedin']; ?>"> <span class="brand-icon me-3"><span class="fab fa-linkedin-in"></span></span>
                      <h5 class="fs-0 text-white mb-0 d-inline-block">Linkedin</h5>
                    </a></li>
                  <li class="mb-2"><a class="text-decoration-none d-flex align-items-center" href="<?= $site['site_twitter']; ?>"> <span class="brand-icon me-3"><span class="fab fa-twitter"></span></span>
                      <h5 class="fs-0 text-white mb-0 d-inline-block">Twitter</h5>
                    </a></li>
                  <li class="mb-2"><a class="text-decoration-none d-flex align-items-center" href="<?= $site['site_facebook']; ?>"> <span class="brand-icon me-3"><span class="fab fa-facebook-f"></span></span>
                      <h5 class="fs-0 text-white mb-0 d-inline-block">Facebook</h5>
                    </a></li>
                  <li class="mb-2"><a class="text-decoration-none d-flex align-items-center" href="<?= $site['site_instagram']; ?>"> <span class="brand-icon me-3"><span class="fab fa-instagram"></span></span>
                      <h5 class="fs-0 text-white mb-0 d-inline-block">Instagram</h5>
                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    
    <!-- ============================================-->


    <footer class="footer bg-primary text-center py-4">
      <div class="container">
        <div class="row align-items-center opacity-85 text-white">
          <div class="col-sm-3 text-sm-start"><a href="#"><img src="/assets/elixir/assets/img/logo-light1.png" alt="logo" /></a></div>
          <!-- <div class="col-sm-6 mt-3 mt-sm-0">
            <p class="lh-lg mb-0 fw-semi-bold">&copy; Copyright UNUSIA <?= date('Y'); ?></p>
          </div> -->
          <div class="col text-sm-end mt-3 mt-sm-0"><span class="fw-semi-bold">Designed by </span><a class="text-white" href="/login" target="_blank">UnusiaLabs</a></div>
        </div>
      </div>
    </footer>

    
    <!-- Template Main JS File -->
    <!-- <script src="/assets/frontend/js/main.js"></script> -->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="/assets/elixir/vendors/popper/popper.min.js"></script>
    <script src="/assets/elixir/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/elixir/vendors/is/is.min.js"></script>
    <script src="/assets/elixir/vendors/bigpicture/BigPicture.js"> </script>
    <script src="/assets/elixir/vendors/countup/countUp.umd.js"> </script>
    <script src="/assets/elixir/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/elixir/vendors/fontawesome/all.min.js"></script>
    <script src="/assets/elixir/vendors/lodash/lodash.min.js"></script>
    <script src="/assets/elixir/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/elixir/vendors/gsap/gsap.js"></script>
    <script src="/assets/elixir/vendors/gsap/customEase.js"></script>
    <script src="/assets/elixir/assets/js/theme.js"></script>

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