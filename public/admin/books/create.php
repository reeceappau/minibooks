<?php

require_once('../../../private/initialize.php');

require_admin();



if(is_post_request()) {

    // Create record using post parameters
    $args = $_POST['book'];
    $book = new Book($args);
    $result = $book->save();

    if($result === true) {
        $new_id = $book->id;
        $session->message('Book created successfully');
        redirect_to(url_for('/admin/books/show.php?id=' . $new_id));
    }

} else {
    // display the form
    $book = new Book;
}



?>

<?php $page_title = 'Create Book'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <a class="back-link" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>

        <div class="bicycle new">
            <h1 class="h3">Create Book</h1>

            <?php echo display_errors($book->errors); ?>


            <form action="<?php echo url_for('/admin/books/create.php'); ?>" method="post">

                <?php include('form_fields.php'); ?>

                <div id="operations">
                    <button type="submit" class="btn btn-primary">Create Book</button>
                </div>
            </form>

        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>