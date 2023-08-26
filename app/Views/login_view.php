<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Login | LPPMI UNUSIA</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/elixir/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/elixir/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/elixir/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/elixir/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="/assets/elixir/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/assets/elixir/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="/assets/elixir/vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="/assets/elixir/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/elixir/vendors/hamburgers/hamburgers.min.css" rel="stylesheet">
    <link href="/assets/elixir/vendors/loaders.css/loaders.min.css" rel="stylesheet">
    <link href="/assets/elixir/assets/css/theme.css" rel="stylesheet" />
    <link href="/assets/elixir/assets/css/user.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&amp;family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
  </head>


  <body>

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


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="text-center py-0">

        <div class="bg-holder overlay overlay-2" style="background-image:url(/assets/backend/images/slider/login.jpg);">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row min-vh-100 align-items-center">
            <div class="col-md-8 col-lg-5 mx-auto" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="mb-5" data-zanim-xs='{"delay":0,"duration":1}'><a href="/"><img src="/assets/elixir/assets/img/logo-light1.png" alt="logo" /></a></div>
              <div class="card" data-zanim-xs='{"delay":0.1,"duration":1}'>
                <div class="card-body p-md-5">
                  <h4 class="text-uppercase fs-0 fs-md-1">login with Lppmi</h4>
                    <?php if (session()->getFlashData('pesan')) : ?>
                        <div class="alert alert-warning" role="alert">
                        <?= session()->getFlashData('pesan') ?>
                        </div>
                    <?php endif; ?>
                  <form class="text-start mt-4" action="/login/validasi" method="post">
                    <div class="row align-items-center">
                      <div class="col-12">
                        <div class="input-group">
                          <div class="input-group-text bg-100"><span class="far fa-user"></span></div>
                          <input class="form-control" type="email" placeholder="Email or username" name="email" aria-label="Text input with dropdown button" required autofocus />
                        </div>
                      </div>
                      <div class="col-12 mt-2 mt-sm-4">
                        <div class="input-group">
                          <div class="input-group-text bg-100"><span class="fas fa-lock"></span></div>
                          <input class="form-control" type="password" placeholder="Password" name="password" aria-label="Text input with dropdown button" required />
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center mt-3">
                      <div class="col-6 mt-2 mt-sm-3">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->
    </main>

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

  </body>

</html>