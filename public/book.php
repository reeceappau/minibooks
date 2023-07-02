<?php require_once('../private/initialize.php'); ?>

<?php

if(!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}

$id = $_GET['id'];

$book = Book::find_by_id($id);

if($book == false) {
    redirect_to(url_for('/index.php'));
}

if (is_post_request()) {
    if (!isset($session->user_id)) {
        $session->message("Log in to add items to cart");
        redirect_to(url_for('/login.php'));
    }
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $session->add_to_cart($id, $quantity, $price);
    $session->message('Book added to cart');
    redirect_to(url_for('/cart.php'));

}


?>


<?php $page_title = 'Show book: ' . h($book->name()); ?>
<?php include(SHARED_PATH . '/public_header.php');?>

    <div class="container">

        <a class="back-link" href="<?php echo url_for('/books.php'); ?>">&laquo; Back to List</a>

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
                    Year: <?php echo h($book->quantity); ?>
                </div>
            </div>

            <div>
                Price: <?php echo h($book->price);?>
            </div>

            <div>
                <form action="<?php echo url_for('/book.php?id=' . h(u($book->id))); ?>" method="post">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $book->quantity;?>" value="1">
                    <input type="hidden" name="price" value="<?php echo $book->price;?>">
                    <input class="btn btn-primary d-inline" type="submit" value="Add to Cart" />
                </form>
            </div>

            <div>
                <?php echo h($book->description); ?>
            </div>

        </div>

    </div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>