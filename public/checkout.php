<?php
require_once('../private/initialize.php');

require_login();

if (!isset($session->cart)) {
    redirect_to(url_for('books.php'));
}

$id = $session->user_id;
$user = User::find_by_id($id);

?>

<?php $page_title = 'Checkout'; ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container">
    <form id="paymentForm">
        <div class="form-group">
            <input type="hidden" id="userEmail" value="<?php echo $user->email; ?>" required />
        </div>
        <div class="form-group">
            <input  type="hidden" id="cartTotal" value="<?php echo $session->cart_total; ?>" required />
        </div>
        <div class="form-submit">
            <button class="btn btn-primary" type="submit" onclick="payWithPaystack()"> Pay GHS <?php echo $session->cart_total; ?></button>
        </div>
    </form>
</div>




<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
            key: 'pk_test_3f19a3c55ec7e142496d3510d4b992da8a067771', // Replace with your public key
            email: document.getElementById("userEmail").value,
            amount: document.getElementById("cartTotal").value * 100,
            currency: 'GHS',
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            onClose: function(){
                <?php
                    $session->message("Payment cancelled");
                ?>
            },
            callback: function(response){
                var reference = response.reference;
                window.location = `http://localhost/minibooks/public/order.php?ref=${reference}`;
            }
        });

        handler.openIframe();
    }

</script>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
