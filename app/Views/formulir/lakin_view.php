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
            <div class="row mt-2">
                <div class="col">
                    <h3 class="text-center fs-2 fs-md-3"><?= $title; ?></h3>
                    <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
                </div>
                <div class="col-12">
                    <div class="bg-white px-3 mt-6 px-0 py-5 px-lg-5 rounded-3">
                        <p>Keterangan lebih lanjut..</p>
                        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRsmVMwm_bEKBzE3Z-28xjsbkaHOp3XMYxPbZ20_yZNDBW1bL_GXhLx01glu0IiW9nTRHBJuUDQddHj/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false" width="100%" height="680"></iframe>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->     

<?= $this->endSection(); ?>