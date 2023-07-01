<?php require_once('../private/initialize.php'); ?>

<?php

// Find all books;
$books = Book::find_all();

//if (is_post_request()) {
//    $quantity = 1;
//    $id = $_GET['id'];
//
//    $session->add_to_cart($id, $quantity);
//    $session->message('Book added to cart');
//    redirect_to(url_for('/cart.php'));
//
//}

?>


<?php include(SHARED_PATH . '/public_header.php'); ?>


<div class="container">

    <h1 class="h3">
        Browse books
    </h1>

    <div class="row">
    <?php foreach($books as $book) { ?>
    <div class="col-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h4 class="card-title"><?php echo h($book->title); ?></h4>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo h($book->author); ?></h6>
                <p class="card-text"><?php echo h(substr($book->description, 0, 150));?>...</p>
                <a href="<?php echo url_for('/book.php?id=' . h(u($book->id))); ?>" class="card-link">View</a>
<!--                <form action="--><?php //echo url_for('/books.php?id=' . h(u($book->id)) . "&title=" . h(u($book->title))); ?><!--" method="post">-->
<!--                    <input class="card-link btn btn-primary" type="submit" value="Add to Cart" />-->
<!--                </form>-->
            </div>
        </div>
    </div>
    <?php } ?>
    </div>


</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
