<?php require_once('../../private/initialize.php'); ?>
<?php require_admin(); ?>

<?php

// Find all books;
$books = Book::find_all();

?>
<?php $page_title = 'MiniBooks | Admin'; ?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="container">

    <h1 class="h3">Manage Books</h1>
    <a href="<?php echo url_for('/admin/books/create.php'); ?>">Create Book</a>





    <div>
        <div class="bicycles listing">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($books as $book) { ?>
                    <tr>
                        <th scope="row"><?php echo h($book->id); ?></th>
                        <td><?php echo h($book->title); ?></td>
                        <td><?php echo h($book->author); ?></td>
                        <td><?php echo h($book->quantity); ?></td>
                        <td><a class="link-primary" href="<?php echo url_for('/admin/books/show.php?id=' . h(u($book->id))); ?>">View</a></td>
                        <td><a class="link-primary" href="<?php echo url_for('/admin/books/edit.php?id=' . h(u($book->id))); ?>">Edit</a></td>
                        <td><a class="link-danger" href="<?php echo url_for('/admin/books/delete.php?id=' . h(u($book->id))); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>
