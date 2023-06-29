<?php

require_once('../../../private/initialize.php');

require_admin();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/admin/books/index.php'));
}
$id = $_GET['id'];
$book = Book::find_by_id($id);
if($book == false) {
    redirect_to(url_for('/admin/index.php'));
}

if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['book'];
    $book->merge_attributes($args);
    $result = $book->save();

    if($result === true) {
        $session->message('Book updated successfully.');
        redirect_to(url_for('/admin/books/show.php?id=' . $id));
    }

}

?>

<?php $page_title = 'Edit Book'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <a class="back-link" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>

        <div class="bicycle edit">
            <h1 class="h3">Edit Book</h1>

            <?php echo display_errors($book->errors); ?>

            <form action="<?php echo url_for('/admin/books/edit.php?id=' . h(u($id))); ?>" method="post">

                <?php include('form_fields.php'); ?>

                <div id="operations">
                    <button type="submit" class="btn btn-primary">Edit Book</button>
                </div>
            </form>

        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>