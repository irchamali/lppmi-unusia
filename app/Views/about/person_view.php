<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs1'); ?>
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
            <div class="text-center">
            <div class="row">
            <?php foreach ($teams as $team) : ?>
                <div class="col-sm-6 col-lg-3 col-md-4 mb-3">
                    <div class="card h-100"><img class="card-img-top" src="/assets/backend/images/team/<?= $team['team_image']; ?>" alt="Reenal Scott" />
                        <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                            <div class="overflow-hidden">
                            <h6 data-zanim-xs='{"delay":0}'><?= $team['team_name']; ?></h6>
                            </div>
                            <div class="overflow-hidden">
                            <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'><?= $team['team_jabatan']; ?></h6>
                            </div>
                            <div class="btn-sm btn-group" role="group" aria-label="Basic outlined example">
                                <a class="btn-sm btn btn-outline-primary" href="<?= $team['team_twitter']; ?>"><span class='fas fa-link'></span></a>
                                <a class="btn-sm btn btn-outline-primary" href="<?= $team['team_instagram']; ?>"><span class='fab fa-instagram'></span></a>
                                <a class="btn-sm btn btn-outline-primary" href="<?= $team['team_linked']; ?>"><span class='fab fa-linkedin'></span></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->     

<?= $this->endSection(); ?>