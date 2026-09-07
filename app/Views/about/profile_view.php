<?= $this->extend('layouts/template-page'); ?>
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
            <!-- slider menu -->
            <?= $this->include('layouts/slider-about'); ?>
            
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
                        <ol class="column-lg-6 mb-4">
                        <?php foreach (preg_split('/\r\n|\r|\n/', $about['about_misi'], -1, PREG_SPLIT_NO_EMPTY) as $misi) : ?>
                          <li><?= esc(trim($misi)); ?></li>
                        <?php endforeach; ?>
                        </ol>
                        <!-- <h5>Strategi</h5>
                        <ol class="column-lg-6 mb-1">
                        <?php foreach (preg_split('/\r\n|\r|\n/', $about['about_strategi'], -1, PREG_SPLIT_NO_EMPTY) as $strategi) : ?>
                          <li><?= esc(trim($strategi)); ?></li>
                        <?php endforeach; ?>
                        </ol> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->     

<?= $this->endSection(); ?>