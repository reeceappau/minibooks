<?php require_once('../private/initialize.php'); ?>

<?php

require_login();

$id = $session->user_id;

// Find all orders;
$orders = Order::find_by_user_id($id);

//$book_id = Order::get_book_id($orders);
//$books = [];
//
//foreach ($book_id as $id) {
//    $sql = "SELECT title FROM books WHERE id IN (" . implode(',', $id) . ")";
//    $books[] = Book::find_by_sql($sql);
//}

?>


<?php include(SHARED_PATH . '/public_header.php'); ?>


<div class="container">

    <h1 class="h3">
        Your orders
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#reference</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order) { ?>
            <tr>
                <th scope="row"><?php echo h($order->reference); ?></th>
                <td>GHS <?php echo h(bcdiv($order->amount, 100, 2)); ?></td>
                <td><?php echo h($order->date_time); ?></td>
            </tr>
<!--            <tr>-->
<!--                <td class="pl-5 text-secondary" colspan="3">-->
<!--                            <table class="table table-borderless text-secondary">-->
<!--                                <tbody>-->
<!---->
<!--                                        --><?php //foreach ($books as $book) {?>
<!--                                            --><?php //foreach ($book as $title) { ?>
<!--                                                <tr>-->
<!--                                                    <td>--><?php //echo $title->title;?><!--</td>-->
<!--                                                    <td>Quantity: 2</td>-->
<!--                                                </tr>-->
<!--                                            --><?php //}?>
<!--                                        --><?php //}?>
<!--                                </tbody>-->
<!--                            </table>-->
<!--                </td>-->
<!--            </tr>-->
        <?php } ?>
        </tbody>
    </table>


</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
