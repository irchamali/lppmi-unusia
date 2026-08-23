<div class="navbar">
    <div class="navbar-inner">
        <div class="sidebar-pusher">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="logo-box">
            <a href="/<?= session('role'); ?>" class="logo-text"><span>UNUSIA</span></a>
        </div><!-- Logo Box -->
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i
                                class="fa fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (session('role') == 'admin') : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic"
                            data-toggle="dropdown"><i class="fa fa-envelope"></i><span
                                class="badge badge-success pull-right"><?= $total_inbox; ?></span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">

                            <li>
                                <p class="drop-title">Anda memiliki <?= $total_inbox; ?> pesan baru !</p>
                            </li>
                            <li class="dropdown-menu-list slimscroll messages">
                                <ul class="list-unstyled">
                                    <?php foreach ($inboxs as $row) : ?>
                                    <li>
                                        <a href="/<?= session('role') ?>/inbox/<?= $row['inbox_id']; ?>">
                                            <div class="msg-img">
                                                <div class="online on"></div><img class="img-circle"
                                                    src="/assets/backend/images/user_blank.png" alt="">
                                            </div>
                                            <p class="msg-name"><?= $row['inbox_name']; ?></p>
                                            <p class="msg-text"><?= word_limiter($row['inbox_message'], 5); ?></p>
                                            <p class="msg-time">
                                                <?= date('d-m-Y H:i:s', strtotime($row['inbox_created_at'])); ?></p>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="/<?= session('role'); ?>/inbox" class="text-center">All
                                    Messages</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic"
                            data-toggle="dropdown"><i class="fa fa-comment"></i><span
                                class="badge badge-success pull-right"><?= $total_comment; ?></span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                            <li>
                                <p class="drop-title">Anda memiliki <?= $total_comment; ?> komentar baru !</p>
                            </li>
                            <li class="dropdown-menu-list slimscroll messages">
                                <ul class="list-unstyled">
                                    <?php foreach ($comments as $row) : ?>
                                    <li>
                                        <a href="/<?= session('role'); ?>/comment">
                                            <div class="msg-img">
                                                <div class="online on"></div><img class="img-circle"
                                                    src="/assets/backend/images/user_blank.png" alt="">
                                            </div>
                                            <p class="msg-name"><?= $row['comment_name']; ?></p>
                                            <p class="msg-text"><?= word_limiter($row['comment_message'], 5); ?></p>
                                            <p class="msg-time">
                                                <?= date('d-m-Y H:i:s', strtotime($row['comment_date'])); ?></p>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="/<?= session('role'); ?>/comment" class="text-center">All
                                    Comments</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic"
                            data-toggle="dropdown">
                            <span class="user-name"><?= $akun['user_name']; ?><i class="fa fa-angle-down"></i></span>
                            <img class="img-circle avatar"
                                src="/assets/backend/images/users/<?= $akun['user_photo']; ?>" width="40" height="40"
                                alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-list" role="menu">
                            <li role="presentation"><a href="/<?= session('role'); ?>/setting/profile"><i
                                        class="fa fa-user"></i>My Profile</a></li>
                            <li role="presentation"><a href="/<?= session('role'); ?>/comment/unpublish"><i
                                        class="fa fa-comment"></i>Comments<span
                                        class="badge badge-success pull-right"><?= $total_comment; ?></span></a></li>
                            <?php if (session('role') == 'admin') : ?>
                            <li role="presentation"><a href="/<?= session('role'); ?>/inbox"><i
                                        class="fa fa-envelope"></i>Inbox<span
                                        class="badge badge-success pull-right"><?= $total_inbox; ?></span></a></li>
                            <?php endif; ?>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a href="/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/logout" class="log-out waves-effect waves-button waves-classic">
                            <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                        </a>
                    </li>
                </ul><!-- Nav -->
            </div><!-- Top Menu -->
        </div>
    </div>
</div>
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">
            <div class="sidebar-profile">
                <a href="javascript:void(0);">
                    <div class="sidebar-profile-image">
                        <img src="/assets/backend/images/users/<?= $akun['user_photo']; ?>"
                            class="img-circle img-responsive" alt="">
                    </div>
                    <div class="sidebar-profile-details">
                        <span><?= $akun['user_name']; ?><br>
                            <small><?= $akun['user_level'] == 1 ? 'Administrator' : 'Author'; ?></small>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu accordion-menu">
            <li class="<?= ($active == 'dashboard') ? 'active' : '' ?>"><a href="/<?= session('role'); ?>"
                    class="waves-effect waves-button"><span class="menu-icon icon-home"></span>
                    <p>Dashboard</p>
                </a></li>
            <li class="droplink <?= ($title === "Profile Setting") ? 'active open' : '' ?><?= ($title === "Website Setting") ? 'active open' : '' ?><?= ($title === "Home Setting") ? 'active open' : '' ?><?= ($title === "All Slider") ? 'active open' : '' ?><?= ($title === "About Setting") ? 'active open' : '' ?>"><a
                    href="/<?= session('role'); ?>/settings" class="waves-effect waves-button"><span
                        class="menu-icon icon-settings"></span>
                    <p>Settings</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= ($title === "Profile Setting") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/setting/profile">My Profile</a></li>
                    <?php if (session('role') == 'admin') : ?>
                    <li class="<?= ($title === "Website Setting") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/setting/web">Website</a></li>
                    <li class="<?= ($title === "Home Setting") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/setting/home">Home</a></li>
                    <li class="<?= ($title === "All Slider") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/slider">Slider</a></li>
                    <li class="<?= ($title === "About Setting") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/setting/about">About</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="droplink <?= ($title === "All Post") ? 'active open' : '' ?><?= ($title === "Add New Post") ? 'active open' : '' ?><?= ($title === "All Category") ? 'active open' : '' ?><?= ($title === "All Tag") ? 'active open' : '' ?>"><a href="#"
                    class="waves-effect waves-button"><span class="menu-icon icon-pin"></span>
                    <p>Post</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= ($title === "All Post") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/post">All Post</a></li>
                    <li class="<?= ($title === "Add New Post") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/post/add_new">Add New</a></li>
                    <li class="<?= ($title === "All Category") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/category">Category</a></li>
                    <li class="<?= ($title === "All Tag") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/tag">Tag</a></li>
                </ul>
            </li>
            
            <?php if (session('role') == 'admin') : ?>
            <li class="droplink <?= ($title === "All Document") ? 'active open' : '' ?><?= ($title === "Category of Document") ? 'active open' : '' ?>"><a
                    href="/<?= session('role'); ?>/document" class="waves-effect waves-button"><span
                        class="menu-icon icon-link"></span>
                    <p>Documents</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= ($title === "All Document") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/document">Document</a></li>
                    <li class="<?= ($title === "Category of Document") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/docscategory">Category</a></li>
                </ul>
            </li>
            <li class="droplink <?= ($title === "Semua Laporan") ? 'active open' : '' ?><?= ($title === "Kategori Laporan") ? 'active open' : '' ?>"><a
                    href="/<?= session('role'); ?>/laporan" class="waves-effect waves-button"><span
                        class="menu-icon icon-eye"></span>
                    <p>Laporan</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">                    
                    <li class="<?= ($title === "Semua Laporan") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/laporan">Laporan</a></li>
                    <li class="<?= ($title === "Kategori Laporan") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/lapcategory">Kategori</a></li>                    
                </ul>
            </li>
            <li class="droplink <?= ($title === "Data Akreditasi") ? 'active open' : '' ?><?= ($title === "Data Program Studi") ? 'active open' : '' ?>"><a
                    href="/<?= session('role'); ?>/laporan" class="waves-effect waves-button"><span
                        class="menu-icon icon-flag"></span>
                    <p>Pusat Data</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">                    
                    <li class="<?= ($title === "Data Akreditasi") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/akreditasi">Akreditasi</a></li>
                    <li class="<?= ($title === "Data Program Studi") ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/prodi">Program Studi</a></li>                    
                </ul>
            </li>
            <li class="<?= ($active == 'inbox') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/inbox" class="waves-effect waves-button"><span
                        class="menu-icon icon-envelope"></span>
                    <p>Inbox</p>
                </a>
            </li>
            <?php endif; ?>

            <li class="<?= ($active == 'comment') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/comment" class="waves-effect waves-button"><span
                        class="menu-icon icon-bubbles"></span>
                    <p>Comments</p>
                </a>
            </li>
            <?php if (session('role') == 'admin') : ?>
            <li class="<?= ($active == 'subscriber') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/subscriber" class="waves-effect waves-button"><span
                        class="menu-icon icon-users"></span>
                    <p>Subscribers</p>
                </a>
            </li>
            <!-- <li class="<?= ($active == 'slider') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/slider" class="waves-effect waves-button"><span
                        class="menu-icon icon-star"></span>
                    <p>Slider</p>
                </a>
            </li> -->
            <li class="<?= ($active == 'member') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/member" class="waves-effect waves-button"><span
                        class="menu-icon icon-key"></span>
                    <p>Member</p>
                </a>
            </li>
            <li class="<?= ($active == 'testimonial') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/testimonial" class="waves-effect waves-button"><span
                        class="menu-icon icon-like"></span>
                    <p>Testimonials</p>
                </a>
            </li>
            <li class="<?= ($active == 'team') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/team" class="waves-effect waves-button"><span
                        class="menu-icon icon-users"></span>
                    <p>Teams</p>
                </a>
            </li>
            <li class="<?= ($active == 'users') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/users" class="waves-effect waves-button"><span
                        class="menu-icon icon-user"></span>
                    <p>Users</p>
                </a>
            </li>
            <?php endif; ?>

            <li>
                <a href="/logout" class="waves-effect waves-button"><span class="menu-icon icon-logout"></span>
                    <p>Log Out</p>
                </a>
            </li>
        </ul>
    </div>
</div>