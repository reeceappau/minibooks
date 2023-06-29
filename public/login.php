<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validations
    if(is_blank($username)) {
        $errors[] = "Username cannot be blank.";
    }
    if(is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to login
    if(empty($errors)) {
        $user = User::find_by_username($username);
        // test if admin found and password is correct
        if($user != false && $user->verify_password($password)) {
            // Mark admin as logged in
            $session->login($user);
            redirect_to(url_for('/admin/index.php'));
        } else {
            // username not found or password does not match
            $errors[] = "Log in was unsuccessful.";
        }

    }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container">
    <h1 class="h3">Log in</h1>

    <?php echo display_errors($errors); ?>

    <form action="login.php" method="post">

        <div class="form-group">
            <label for="userUsername">Username</label>
            <input type="text" class="form-control" id="userUsername" name="username" value="<?php echo h($username); ?>">
        </div>

        <div class="form-group">
            <label for="userPassword">Password</label>
            <input type="password" class="form-control" id="userPassword" name="password" >
        </div>

        <input class="btn btn-primary" type="submit" name="submit" value="Log In"  />
    </form>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
