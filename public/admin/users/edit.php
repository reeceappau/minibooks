<?php

require_once('../../../private/initialize.php');

require_admin();



if(!isset($_GET['id'])) {
    redirect_to(url_for('/admin/users/index.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
    redirect_to(url_for('/admin/admins/index.php'));
}

if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['user'];
    $user->merge_attributes($args);
    $result = $user->save();

    if ($result === true) {
        $session->message('Changes have been saved.');
        redirect_to(url_for('/admin/users/index.php'));
    }
}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <div>
            <h1 class="h3">Edit Admin User</h1>

            <?php echo display_errors($user->errors); ?>

            <form action="<?php echo url_for('/admin/users/edit.php?id=' . h(u($id))); ?>" method="post">


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

                <?php  if($user->role === "admin") {?>
                <div class="form-group">
                    <label class="d-block" for="userRole">Role</label>
                    <select class="form-select"  id="userRole" name="user[role]" aria-label="Default select example">
                        <option selected value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
    <?php }else {?>
                    <div class="form-group">
                        <label class="d-block" for="userRole">Role</label>
                        <select class="form-select"  id="userRole" name="user[role]" aria-label="Default select example">
                            <option selected value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
        <?php } ?>
                <h2 class="h5 mt-5">Change Password</h2>

                <div class="form-group">
                    <label for="userPassword">Old Password</label>
                    <input type="password" class="form-control" id="userPassword" name="user[old_password]" >
                </div>

                <div class="form-group">
                    <label for="userPassword">New Password</label>
                    <input type="password" class="form-control" id="userPassword" name="user[password]" >
                </div>

                <div class="form-group">
                    <label for="userConfirmPassword">Confirm New Password</label>
                    <input type="password" class="form-control" id="userConfirmPassword" name="user[confirm_password]" >
                </div>

                <div id="operations">
                    <input class="btn btn-primary" type="submit" value="Edit User" />
                </div>
            </form>

        </div>

    </div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>