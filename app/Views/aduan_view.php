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
                <h3 class="text-center fs-2 fs-md-3">Form <?= $title; ?></h3>
                <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
                </div>
                <div class="col-12">
                <div class="bg-white px-3 mt-6 px-0 py-5 px-lg-5 rounded-3">
                <!-- <h5>Note:</h5> -->
                <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                    <h5 class="fw-medium ms-3 mb-0">Segera laporkan dan sertakan bukti. Jangan takut, data Anda aman dengan kami!</h5>
                </blockquote><br>
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdViX5WfGHnt1BEN-cF3vKWN2PCh8WgRY08i1BucKgUXT4aiQ/viewform?embedded=true" width="100%" height="3000" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                    <br>                    
                </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->  

<?= $this->endSection(); ?>