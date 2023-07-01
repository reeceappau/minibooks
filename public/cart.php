<?php require_once('../private/initialize.php'); ?>

<?php

require_login();

// Find all books;
$sql = "SELECT * FROM books WHERE id IN (" . implode(',', array_keys($session->cart)) . ")";
$books = Book::find_by_sql($sql);

if (is_post_request()) {
    $id = $_GET['id'];
    if (isset($_POST['editCart'])) {
        $quantity = $_POST['quantity'];
        $session->update_cart($id, $quantity);
        $session->message("Cart edit successful");
        redirect_to(url_for('/cart.php'));
    }

    if (isset($_POST['deleteCart'])) {
        $session->remove_from_cart($id);
        $session->message("Cart deleted");
        redirect_to(url_for('/cart.php'));
    }
}

?>
<?php $page_title = 'Cart'; ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>
<?php echo display_session_message(); ?>

<div class="container">

    <h1 class="h3">Cart</h1>

    <div>
        <div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($books as $book) { ?>
                    <tr>
                        <th scope="row"><?php echo h($book->id); ?></th>
                        <td><?php echo h($book->title); ?></td>
                        <td>
                            <form action="<?php echo url_for('/cart.php?id=' . h(u($book->id))); ?>" method="post">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" max="<?php echo $book->quantity;?>" value="<?php echo $session->cart[$book->id]?>">
                                <input class="btn btn-primary d-inline" type="submit" value="Edit" name="editCart"/>
                            </form>
                        </td>
                        <td>
                            <form action="<?php echo url_for('/cart.php?id=' . h(u($book->id))); ?>" method="post">
                                <input class="btn btn-danger d-inline" type="submit" value="Delete" name="deleteCart"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
