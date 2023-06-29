<?php require_once('../private/initialize.php'); ?>

<?php

// Find all books;
$books = Book::find_all();

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
            </div>
        </div>
    </div>
    <?php } ?>
    </div>


</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
