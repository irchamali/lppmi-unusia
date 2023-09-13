<?= $this->extend('layout/template-post'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <article class="blog-details">

              <div class="post-img">
                <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="" class="img-fluid">
              </div>

              <h2 class="title"><?= $post['post_title']; ?></h2>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="/author/<?= $post['post_user_id']; ?>"> <?= $post['user_name']; ?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01"><?= date('d M Y', strtotime($post['post_date'])); ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html"><?= $post['comment_total']; ?> Comments</a></li>
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                <?= $post['post_contents']; ?> 

              </div><!-- End post content -->

              <div class="meta-bottom">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li><a href="/category/<?= $post['category_slug']; ?>"><?= $post['category_slug']; ?></a></li>
                </ul>

                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><?php foreach ($post_tags as $tag) : ?> <a href="/tag/<?= $tag; ?>"><?= $tag; ?></a> &vert; <?php endforeach; ?>
                    </li>
                </ul>
              </div><!-- End meta bottom -->

            </article><!-- End blog post -->

            <!-- <div class="post-author d-flex align-items-center">
              <img src="frontend2/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="">
              <div>
                <h4>Jane Smith</h4>
                <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p>
              </div>
            </div> -->
            <!-- End post author -->

            <div class="comments">

              <h4 class="comments-count"><?= $post['comment_total']; ?> Comments</h4>

              <div id="comment-2" class="comment">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="d-flex">
                                    <div class="comment-img"><img alt="" src="/assets/backend/images/<?= $comment['comment_image']; ?>">
                                    </div>
                                    <div>
                                        <h5><?= $comment['comment_name']; ?></h5>
                                        <time datetime="2020-01-01"><?= date('d M Y H:i:s', strtotime($comment['comment_date'])); ?></time>
                                        <p>
                                            <?= $comment['comment_message']; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                $commentModel = new App\Models\CommentModel;
                                $replies = $commentModel->where('comment_parent', $comment['comment_id'])->get()->getResultArray();
                                ?>
                                <?php foreach ($replies as $reply) : ?>
                                    <div id="comment-reply-1" class="comment comment-reply">
                                        <div class="d-flex">
                                            <div class="comment-img"><img alt="" src="/assets/backend/images/users/<?= $reply['comment_image']; ?>">
                                            </div>
                                            <div>
                                                <h5><a href="javascript:void(0)"><?= $reply['comment_name']; ?></a>
                                                </h5>
                                                <time datetime="2020-01-01"><?= date('d M Y H:i:s', strtotime($reply['comment_date'])); ?></time>
                                                <p>
                                                    <?= $reply['comment_message']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>

              <div class="reply-form">

                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <?= session()->getFlashData('msg') ?? '' ?>
                <form method="post" action="/post/send_comment" role="form">
                  <div class="row">
                    <input type="hidden" name="post_id" value="<?= $post['post_id']; ?>" required>
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" maxlength="100" required class="form-control" placeholder="Your Name*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="email" maxlength="100" required class="form-control" placeholder="Your Email*">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="message" class="form-control" placeholder="Your Comment*" maxlength="400" required></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div>

          <div class="col-lg-4">
            
          <?= $this->include('layout/sidebar'); ?>
            <!-- End Blog Sidebar -->

          </div>
        </div>

      </div>
    </section>
    <!-- End Blog Details Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>