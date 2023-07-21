<div class="sidebar">

    <div class="sidebar-item search-form">
        <h3 class="sidebar-title">Search</h3>
        <form action="/search" method="GET" class="mt-3">
            <input type="text" name="search_query" placeholder="Search..." required>
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End sidebar search formn-->

    <!-- <div class="sidebar-item categories">
        <h3 class="sidebar-title">Categories</h3>
        <ul class="mt-3">
            <li><a href="#">General <span>(25)</span></a></li>
            <li><a href="#">Lifestyle <span>(12)</span></a></li>
            <li><a href="#">Travel <span>(5)</span></a></li>
            <li><a href="#">Design <span>(22)</span></a></li>
            <li><a href="#">Creative <span>(8)</span></a></li>
            <li><a href="#">Educaion <span>(14)</span></a></li>
        </ul>
    </div> -->
    <!-- End sidebar categories-->

    <div class="sidebar-item recent-posts">
        <h3 class="sidebar-title">Recent Posts</h3>

        <div class="mt-3">
        <?php foreach ($related_post as $row) : ?>
            <div class="post-item mt-3">
            <a href="/post/<?= $row['post_slug']; ?>">
                <img src="/assets/backend/images/post/<?= $row['post_image']; ?>" alt="">
                <div>
                    <h4><a href="/post/<?= $row['post_slug']; ?>"><?= $row['post_title']; ?></a></h4>
                    <time datetime="2020-01-01"><?= date('d M Y', strtotime($row['post_date'])); ?></time>
                </div>
                </a>
            </div><!-- End recent post item-->
            <?php endforeach; ?>
        </div>

    </div><!-- End sidebar recent posts-->

    <div class="sidebar-item tags">
        <h3 class="sidebar-title">Tags</h3>
        <ul class="mt-3">
        <?php foreach ($tags as $tag) : ?>
                <li><a href="/tag/<?= $tag['tag_name']; ?>"><?= $tag['tag_name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- End sidebar tags-->

</div>