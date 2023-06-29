<?php

require_once('../../../private/initialize.php');

require_admin();


if(!isset($_GET['id'])) {
    redirect_to(url_for('/admin/users/index.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
    redirect_to(url_for('/admin/users/index.php'));
}

if(is_post_request()) {

    // Delete admin
    $result = $user->delete();
    $session->message('User deleted successfully.');
    redirect_to(url_for('/admin/users/index.php'));

}

?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <div>
            <h1 class="h3">
                <?php echo h($user->full_name()); ?>
            </h1>
            <p>Are you sure you want to delete this user?</p>

            <form action="<?php echo url_for('/admin/users/delete.php?id=' . h(u($id))); ?>" method="post">
                <div id="operations">
                    <input class="btn btn-danger" type="submit" name="commit" value="Delete User" />
                </div>
            </form>
        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>