<?= $this->extend('layout/template-page'); ?>
<?= $this->section('content'); ?>

<section>
  <div class="bg-holder overlay" style="background-image:url(/assets/elixir/assets/img/background-2.jpg);background-position:center bottom;"></div>
  <div class="container">
    <div class="row pt-6">
      <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
        <div class="overflow-hidden">
          <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>Contact</h1>
          <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
            <ol class="breadcrumb fs-1 ps-0 fw-bold">
              <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-100" id="message-box">
  <div class="container">
    <div class="row align-items-stretch justify-content-center mb-4">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card h-100">
          <div class="card-body px-5">
            <h5 class="mb-3">Alamat Kantor</h5>
            <p class="mb-0 text-1100"><?= esc($site['site_address']); ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card h-100">
          <div class="card-body px-5">
            <h5 class="mb-3">Kontak</h5>
            <p class="mb-1 text-1100">Email: <?= esc($site['site_mail']); ?></p>
            <p class="mb-0 text-1100">WhatsApp: <?= esc($site['site_wa']); ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card h-100">
          <div class="card-body px-5">
            <h5>Socials</h5>
            <a class="d-inline-block mt-2" href="<?= esc($site['site_linkedin']); ?>"><span class="fab fa-linkedin fs-2 me-2 text-primary"></span></a>
            <a class="d-inline-block mt-2" href="<?= esc($site['site_twitter']); ?>"><span class="fab fa-twitter-square fs-2 mx-2 text-primary"></span></a>
            <a class="d-inline-block mt-2" href="<?= esc($site['site_facebook']); ?>"><span class="fab fa-facebook-square fs-2 mx-2 text-primary"></span></a>
            <a class="d-inline-block mt-2" href="<?= esc($site['site_instagram']); ?>"><span class="fab fa-instagram-square fs-2 ms-2 text-primary"></span></a>
          </div>
        </div>
      </div>
    </div>

    <?php if (session('success')) : ?>
      <div class="alert alert-success"><?= esc(session('success')); ?></div>
    <?php endif; ?>
    <?php if (session('danger')) : ?>
      <div class="alert alert-danger"><?= esc(session('danger')); ?></div>
    <?php endif; ?>

    <div class="card mb-4">
      <div class="card-body p-5 h-100">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4594555269905!2d106.84882731476908!3d-6.202960995509508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f46f1aa68feb%3A0x1025d8e539e14ede!2sUniversitas%20Nahdlatul%20Ulama%20Indonesia%20(UNUSIA)%20Jakarta!5e0!3m2!1sid!2sid!4v1689930984692!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

    <div class="card">
      <div class="card-body h-100 p-5">
        <h5 class="mb-3">Write to us</h5>
        <form method="post" action="/contact">
          <?= csrf_field(); ?>
          <div class="mb-4">
            <input class="form-control bg-white" type="text" name="inbox_name" placeholder="Your Name" required="required" />
          </div>
          <div class="mb-4">
            <input class="form-control bg-white" type="email" name="inbox_email" placeholder="Email" required="required" />
          </div>
          <div class="mb-4">
            <input class="form-control bg-white" type="text" name="inbox_subject" placeholder="Subject" required="required" />
          </div>
          <div class="mb-4">
            <textarea class="form-control bg-white" rows="8" name="inbox_message" placeholder="Enter your descriptions here..." required="required"></textarea>
          </div>
          <button class="btn btn-md-lg btn-primary" type="submit"><span class="text-white fw-600">Send Now</span></button>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>
