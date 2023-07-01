<?php require_once('../../../private/initialize.php'); ?>
<?php require_admin(); ?>

<?php

if(!isset($_GET['id'])) {
    redirect_to(url_for('/admin/index.php'));
}

$id = $_GET['id'];

$book = Book::find_by_id($id);

if($book == false) {
    redirect_to(url_for('/admin/index.php'));
}

?>


<?php $page_title = 'Show book: ' . h($book->name()); ?>
<?php include(SHARED_PATH . '/admin_header.php');?>

<div class="container">

    <a class="back-link" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>



        <div class="mt-5">

            <h1 class="h3">
                <?php echo h($book->title); ?>
                <small class="text-muted">by <?php echo h($book->author); ?></small>
            </h1>

            <div class="my-2">
                <div class="d-inline text-muted">
                    Pages: <?php echo h($book->pages); ?>
                </div>
                <div class="d-inline m-2 text-muted">
                    Year: <?php echo h($book->year); ?>
                </div>
                <div class="d-inline m-2 text-muted">
                    Quantity: <?php echo h($book->quantity); ?>
                </div>
            </div>

            <div>
                <?php echo h($book->description); ?>
            </div>

        </div>



</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>