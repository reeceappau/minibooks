<!doctype html>

<html lang="en">
<head>
    <title>MiniBooks <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="<?php echo url_for('/index.php'); ?>">
            MiniBooks
        </a>

        <!-- Toggle button -->
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url_for('/books.php'); ?>">Books</a>
                </li>
                <?php if ($session->is_admin()) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url_for('/admin/index.php'); ?>">Admin</a>
                    </li>
                <?php } ?>
                <?php if ($session->is_logged_in()) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url_for('/profile.php?id='. $session->user_id); ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url_for('/logout.php'); ?>">Logout</a>
                    </li>
                    <?php if (isset($session->cart)) {?>
                    <li class="pl-5 nav-item">
                        <a class="nav-link" href="<?php echo url_for('/cart.php'); ?>">Cart (<?php echo $session->cart_count(); ?>)</a>
                    </li>
                        <?php } ?>
                <?php } else {?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url_for('/login.php'); ?>">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url_for('/register.php'); ?>">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
