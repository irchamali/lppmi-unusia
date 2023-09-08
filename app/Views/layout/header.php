<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title; ?> | <?= $site['site_name']; ?></title>
  <meta content="<?= $post['post_description'] ?? $site['site_description']; ?>" name="description">
  <meta content="UNUSIA, LPPMI, LPPMI UNUSIA, NU, Universitas Nahdlatul Ulama Indonesia" name="keywords">

  <!-- Favicons -->
  <link href="/assets/frontend/img/favicon.png" rel="icon">
  <link href="/assets/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/frontend/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/frontend/css/main.css" rel="stylesheet">

  <!-- DataTables -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: Impact
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-star d-flex align-items-center"><span>PRIOKSITAS</span></i>
        <i class="bi bi-envelope d-flex align-items-center ms-4"><span><a href="mailto:<?= $site['site_mail']; ?>"><?= $site['site_mail']; ?></a></span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="<?= $site['site_twitter']; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="<?= $site['site_facebook']; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="<?= $site['site_instagram']; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="<?= $site['site_linkedin']; ?>" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>
  <!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="/assets/elixir/assets/img/logo-light1.png" alt="">
        <!-- <h1>Lppmi<span>.</span></h1> -->
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a href="#hero">Home</a></li> -->
          <li class="dropdown"><a href="/about"><span>Tentang</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="/about">Profil</a></li>
              <li><a href="/strategymap">Strategy Map</a></li>
              <li><a href="/milestone">Milestone</a></li>
              <li><a href="/deskripsitugas">Deskripsi Tugas</a></li>
              <li><a href="/strukturorganisasi">Struktur Organisasi</a></li>
              <li><a href="/team">Personil LPPMI</a></li>
              <li><a href="/alurkerja">Alur Kerja</a></li>
              <li><a href="/monevrutin">Monev Rutin</a></li>
            </ul>
          </li>
          <li><a href="/akreditasi">Akreditasi</a></li>
          <li><a href="/document">Dokumen</a></li>
          <!-- <li class="dropdown"><a href="/document"><span>Dokumen</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Drop Down 2</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Sub Drop Down 1</a></li>
                  <li><a href="#">Sub Drop Down 2</a></li>
                  <li><a href="#">Sub Drop Down 3</a></li>
                  <li><a href="#">Sub Drop Down 4</a></li>
                  <li class="dropdown"><a href="#"><span>Drop Down 5</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                    <li><a href="#">Sub Down 1</a></li>
                    <li><a href="#">Sub Down 2</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li class="dropdown"><a href="/laporan"><span>Laporan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="/laporan/hasil-survei">Hasil Survei</a></li>
              <li><a href="/laporan/tracer-study">Tracer Study</a></li>
              <li><a href="/laporan/monev-akademik">Monev Akademik</a></li>
              <li><a href="/laporan/monev-nonakademik">Monev Nonakademik</a></li>
              <li><a href="/laporan/audit-akademik">Audit Akademik</a></li>
              <li><a href="/laporan/audit-nonakademik">Audit Nonakademik</a></li>
              <!-- <li class="dropdown"><a href="#"><span>Drop Down 2</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Sub Drop Down 1</a></li>
                  <li><a href="#">Sub Drop Down 2</a></li>
                  <li><a href="#">Sub Drop Down 3</a></li>
                  <li><a href="#">Sub Drop Down 4</a></li>
                </ul>
              </li> -->
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Formulir</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="/ami">Daftar Tilik AMI</a></li>
              <li><a href="#">Daftar Tilik Audit Nonakademik</a></li>
              <li><a href="#">Formulir ...</a></li>
              <li><a href="#">Template Renstra</a></li>
              <li><a href="#">Template RENOP</a></li>
              <li><a href="#">Template LAKIN</a></li>
              <li><a href="#">Formulir Buku 4</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Data</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="https://unusia.ac.id/pimpinan">Pimpinan Universitas</a></li>
              <li><a href="https://unusia.ac.id/pendidikan">Pengelola Fakultas</a></li>
              <li><a href="https://unusia.ac.id/prodi">Pengelola Prodi</a></li>
            </ul>
          </li>
          <li><a href="/post">Berita</a></li>
          <li><a href="/gallery">Galeri</a></li>
          <li><a href="/contact">Kontak</a></li>
          <li><a href="/pengaduan">Pengaduan</a></li>
          
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>
  <!-- End Header -->