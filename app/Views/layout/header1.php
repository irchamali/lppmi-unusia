<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title><?= $title; ?> | <?= $site['site_title']; ?></title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/backend/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/backend/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/backend/images/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/backend/images/favicons/favicon.ico">
    <link rel="manifest" href="/assets/elixir/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/assets/backend/assets/images/favicons/mstile-150x150.png">
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
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&amp;family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
  </head>


  <body>
    <div class="bg-primary py-3 d-none d-sm-block text-white fw-bold">
      <div class="container">
        <div class="row align-items-center gx-4">
          <div class="col-auto d-none d-lg-block fs--1"><span class="fas fa-star text-warning me-2" data-fa-transform="grow-3"></span>P R I O K S I T A S</div>
          <div class="col-auto ms-md-auto order-md-2 d-none d-sm-flex fs--1 align-items-center"><span class="fas fa-map-marker-alt text-warning me-2" data-fa-transform="grow-3"></span><a class="ms-2 fs--1 d-inline text-white fw-bold" href="https://goo.gl/maps/CwfyWxpz9bTSWzgm9"><?= $site['site_address']; ?></a></div>
          <div class="col-auto"><span class="far fa-envelope text-warning" data-fa-transform="shrink-3"></span><a class="ms-2 fs--1 d-inline text-white fw-bold" href="mailto:<?= $site['site_mail']; ?>"><?= $site['site_mail']; ?></a></div>
        </div>
      </div>
    </div>
    <div class="sticky-top navbar-elixir">
      <div class="container">
        <nav class="navbar navbar-expand-lg"> <a class="navbar-brand" href="/"><img src="/assets/elixir/assets/img/logo-dark1.png" alt="logo" /></a>
          <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbarCollapse" aria-controls="primaryNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="hamburger hamburger--emphatic"><span class="hamburger-box"><span class="hamburger-inner"></span></span></span></button>
          <div class="collapse navbar-collapse" id="primaryNavbarCollapse">
            <ul class="navbar-nav py-3 py-lg-0 mt-1 mb-2 my-lg-0 ms-lg-n1">

                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/about">Profil</a></li>
                        <li><a class="dropdown-item" href="/strategymap">Strategy Map</a></li>
                        <li><a class="dropdown-item" href="/milestone">Milestone</a></li>
                        <li><a class="dropdown-item" href="/deskripsitugas">Deskripsi Tugas Kerja</a></li>
                        <li><a class="dropdown-item" href="/strukturorganisasi">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="/team">Personel LPPMI</a></li>
                        <li><a class="dropdown-item" href="/alurkerja">Alur Kerja dan PJ</a></li>
                        <li><a class="dropdown-item" href="/monevrutin">Monev Rutin</a></li>                    
                    </ul>
                </li>

                <li class="nav-item dropdown"><a class="nav-link" href="/akreditasi" role="button">Akreditasi</a>
                </li>

                <li class="nav-item dropdown"><a class="nav-link" href="/document" role="button">Dokumen</a>
                </li>

                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="/laporan" role="button" data-bs-toggle="dropdown" aria-expanded="false">Laporan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/laporan/hasil-survei">Hasil Survei</a></li>
                        <li><a class="dropdown-item" href="/laporan/tracer-study">Tracer Study</a></li>
                        <li><a class="dropdown-item" href="/laporan/monev-akademik">Monev Akademik</a></li>
                        <li><a class="dropdown-item" href="/laporan/monev-nonakademik">Monev Nonakademik</a></li>
                        <li><a class="dropdown-item" href="/laporan/audit-akademik">Audit Akademik</a></li>
                        <li><a class="dropdown-item" href="/laporan/audit-nonakademik">Audit Nonakademik</a></li>
                    </ul>
                </li>
              
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Formulir</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/ami">Daftar Tilik AMI</a></li>
                    <li><a class="dropdown-item" href="#">Daftar Tilik Audit Nonakademik</a></li>
                    <li><a class="dropdown-item" href="#">Formulir ...</a></li>
                    <li><a class="dropdown-item" href="#">Template Renstra</a></li>
                    <li><a class="dropdown-item" href="#">Template RENOP</a></li>
                    <li><a class="dropdown-item" href="#">Template LAKIN</a></li>
                    <li><a class="dropdown-item" href="#">Formulir Buku 4</a></li>
                  
                </ul>
              </li>

              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Data</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://unusia.ac.id/pimpinan">Pimpinan Universitas</a></li>
                        <li><a class="dropdown-item" href="https://unusia.ac.id/pendidikan">Pimpinan Fakultas</a></li>
                        <li><a class="dropdown-item" href="https://unusia.ac.id/prodi">Pimpinan Prodi</a></li>
                    </ul>
                </li>
              
              <li class="nav-item dropdown"><a class="nav-link" href="/post" role="button">Berita</a>
              </li>

              <li class="nav-item dropdown"><a class="nav-link" href="/contact" role="button">Kontak</a>
              </li>

            </ul>
            <a class="btn btn-outline-primary rounded-pill btn-sm border-2 d-block d-lg-inline-block ms-auto my-3 my-lg-0" href="/pengaduan" target="_blank">Pengaduan</a>
          </div>
        </nav>
      </div>
    </div>
