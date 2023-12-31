<?php

require_once('../../../private/initialize.php');

require_admin();



if(is_post_request()) {

    // Create record using post parameters
    $args = $_POST['user'];
    $args['role'] = "admin";
    $user = new User($args);
    $result = $user->save();

    if($result === true) {
        $new_id = $user->id;
        $session->message('User created successfully.');
        redirect_to(url_for('/admin/users/index.php'));
    }

} else {
    // display the form
    $user = new User;
}

?>

<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <div>
            <h1 class="h3">Create Admin User</h1>

            <?php echo display_errors($user->errors); ?>

            <form action="<?php echo url_for('/admin/users/create.php'); ?>" method="post">


                <div class="form-row">
                    <div class="col">
                        <label for="userFirstName">First Name</label>
                        <input type="text" name="user[first_name]" value="<?php echo h($user->first_name); ?>" class="form-control" id="userFirstName">
                    </div>
                    <div class="col">
                        <label for="userLastName">Last Name</label>
                        <input type="text" name="user[last_name]" value="<?php echo h($user->last_name); ?>" class="form-control" id="userLastName">
                    </div>
                </div>

                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="email" class="form-control" id="userEmail" name="user[email]" value="<?php echo h($user->email); ?>" >
                </div>

                <div class="form-group">
                    <label for="userUsername">Username</label>
                    <input type="text" class="form-control" id="userUsername" name="user[username]" value="<?php echo h($user->username); ?>" >
                </div>

                <div class="form-group">
                    <select class="form-select"  id="userUsername" name="user[role]" aria-label="Default select example">
                        <option selected value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="userPassword">Password</label>
                    <input type="password" class="form-control" id="userPassword" name="user[password]" >
                </div>

                <div class="form-group">
                    <label for="userConfirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="userConfirmPassword" name="user[confirm_password]" >
                </div>

                <div id="operations">
                    <input class="btn btn-primary" type="submit" value="Create User" />
                </div>
            </form>

        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>