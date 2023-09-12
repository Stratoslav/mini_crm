<?php
$title = "user list";

ob_start();
?>

<section class="users">
    <h1>User List</h1>
    <a href="/users/create" class="btn btn-success">Create user</a>
    <table>
        <thead>
            <tr class="user-tr">
                <th class="user-th" class="col">#</th>
                <th class="user-th" class="col">LOgin</th>
                <th class="user-th" class="col">Role</th>
                <th class="user-th" class="col">Email</th>
                <th class="user-th" class="col">Email Verification</th>
                <th class="user-th" class="col">Admin</th>
                <th class="user-th" class="col">Created At</th>

                <th class="user-th">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($users as $user) : ?>
                <tr class="users-tr">
                    <th class="user-td" scope="row"><?php echo $user['id'] ?></th>
                    <td class="user-td"> <?php echo $user['username'] ?></td>
                    <td class="user-td"> <?php echo $user['role'] ?></td>
                    <td class="user-td"> <?php echo $user['email'] ?></td>
                    <td class="user-td"> <?php echo $user['email_verification'] == 1 ? 'Yes' : 'No' ?></td>
                    <td class="user-td"> <?php echo $user['role'] ? 'yes' : 'no'; ?></td>
                    <td class="user-td"> <?php echo $user['created_at'] ?></td>
                    <td class="users-action user-td">
                        <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</section>


<?php $content = ob_get_clean();


include './app/views/layout.php';
