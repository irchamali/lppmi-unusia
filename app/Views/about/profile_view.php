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
            <!-- slider menu -->
            <?= $this->include('layout/slider-about'); ?>
            
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
                        <p class="column-lg-6 mb-1">
                        1. Mewujudkan Good University Governance melalui pengawasan dan penjaminan mutu bidang akademik dan nonakademik.<br> 
                        2. Memastikan pelaksanaan sistem mutu dan tata kelola yang mengandung prinsip profesional, independen, objektif, kredibel, berintegritas, dan meningkatkan budaya kolaborasi.<br>
                        3. Menyusun peta risiko (manajemen risiko) bidang akademik dan nonakademik guna perbaikan berkelanjutan.<br>
                        4. Melakukan pengawasan tata kelola bidang pengelolaan keuangan, perencanaan dan sarana prasarana, sumber daya manusia, kemahasiswaan, kerja sama, serta hal terkait nonakademik lainnya.<br>
                        5. Menjamin dan mendampingi proses sistem penjaminan mutu akademik dan nonakademik melalui siklus Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan (PPEPP) satu kali dalam satu tahun akademik.<br>
                        6. Melakukan reviu, evaluasi, pemantauan, dan bentuk pengawasan lainnya atas kegiatan objek pengawasan dan pemeriksaan kinerja akademik dan nonakademik universitas.<br>
                        7. Memberikan rekomendasi perbaikan dalam rangka meningkatkan mutu dan tata kelola serta kinerja akademik dan nonakademik universitas.<br>
                        8. Melaksanakan kegiatan peningkatan kapasitas personel LPPMI UNUSIA.<br> 
                        9. Bekerja sama dan berkolaborasi dengan lembaga terkait yang berasal dari perguruan tinggi lain ataupun lembaga lain yang terkait guna meningkatkan inovasi dan kinerja LPPMI UNUSIA serta mutu UNUSIA secara keseluruhan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->     

<?= $this->endSection(); ?>