<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container">

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="display-5 fw-bold">MiniBooks</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">#1 bookstore in Ghana.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a class="btn btn-primary btn-lg px-4 gap-3" href="<?php echo url_for('/books.php'); ?>">Browse books</a>
            </div>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
