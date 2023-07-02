<?php
require_once('../private/initialize.php');

require_login();

if (!isset($_GET['ref'])) {
    redirect_to(url_for('/cart.php'));
}

if (!isset($session->cart)) {
    redirect_to(url_for('books.php'));
}

date_default_timezone_set("Africa/Accra");
$curl = curl_init();
$ref = $_GET['ref'];

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". raw_u($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_4a5bfd83b28e3624627fc334a86f20397533f9c3",
        "Cache-Control: no-cache",
    ),
));

$response = curl_exec($curl);
$curl_err = curl_error($curl);

curl_close($curl);

if ($curl_err) {
    echo "cURL Error #:" . $curl_err;
} else {
    $response = json_decode($response);
    $status = $response->data->status;
    if ($status == "success") {
        $user_email = $response->data->customer->email;
        $amount_paid = $response->data->amount;


        $args = [];
        $args['user_id'] = $session->user_id;
        $args['amount'] = $response->data->amount;
        $args['reference'] = $response->data->reference;
        $args['date_time'] = date('d/m/y H:i');

        // loop through cart and insert book ids and quantity into an array
        $books_array = [];
        $quantity_array = [];
        foreach ($session->cart as $key=>$value) {
            $books_array[] = $key;
            $quantity_array[] = $value;
        }

        //convert books and quantity array to string
        $args['book_id'] = implode(",", $books_array);
        $args['quantity'] = implode(",", $quantity_array);

        $order = new Order($args);
        $result = $order->save();

        if ($result) {
            $session->delete_cart();
        }

    }
}
?>

<?php $page_title = 'Checkout'; ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container">
    <h1 class="h3">Order completed successfully</h1>
    <a class="btn btn-primary" href="<?php echo url_for('/orders.php')?>">View Orders</a>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>