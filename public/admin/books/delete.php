<?php

require_once('../../../private/initialize.php');

require_admin();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/admin/books/index.php'));
}
$id = $_GET['id'];
$book = Book::find_by_id($id);
if($book == false) {
    redirect_to(url_for('/admin/books/index.php'));
}

if(is_post_request()) {

    // Delete bicycle
    $result = $book->delete();
    $session->message('Book deleted successfully');
    redirect_to(url_for('/admin/index.php'));

}

?>

<?php $page_title = 'Delete Book'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <a class="link-secondary m-4" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>

        <div class="bicycle delete">
            <h1 class="h3">
                <?php echo h($book->title); ?>
                <small class="text-muted">by <?php echo h($book->author); ?></small>
            </h1>
            <p>Are you sure you want to delete this book?</p>

            <form action="<?php echo url_for('/admin/books/delete.php?id=' . h(u($id))); ?>" method="post">
                <div id="operations">
                    <input type="submit" name="commit" value="Delete Book" class="btn btn-danger"/>
                </div>
            </form>
        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>