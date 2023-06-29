<?php require_once('../../../private/initialize.php'); ?>
<?php
require_admin();


// Find all books;
    $users = User::find_all();
$page_title = 'MiniBooks | Users';
    ?>


<?php include(SHARED_PATH . '/admin_header.php'); ?>

    <div class="container">

        <h1 class="h3">Manage Users</h1>
        <a href="<?php echo url_for('/admin/users/create.php'); ?>">Create User</a>


        <div>
            <div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo h($user->id); ?></th>
                            <td><?php echo h($user->first_name); ?></td>
                            <td><?php echo h($user->last_name); ?></td>
                            <td><?php echo h($user->username); ?></td>
                            <td><?php echo h($user->email); ?></td>
                            <td><?php echo h($user->role); ?></td>
                            <td><a class="link-primary" href="<?php echo url_for('/admin/users/edit.php?id=' . h(u($user->id))); ?>">Edit</a></td>
                            <td><a class="link-danger" href="<?php echo url_for('/admin/users/delete.php?id=' . h(u($user->id))); ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>


    <?php include(SHARED_PATH . '/admin_footer.php'); ?>


</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
