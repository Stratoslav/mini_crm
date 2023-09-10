<?php
$title = "edit user";

ob_start();
?>
<section class="edit-user">
    <h1>Edit User</h1>


    <form method="POST" action="/users/update/<?= $user['id']?>">

        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input value="<?= $user['username']?>" name="username" type="text" id="username" class="form-control"
                placeholder="enter the username">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input value="<?= $user['email']?>" name="email" type="text" id="email" class="form-control"
                placeholder="enter the email">
        </div>
        <select name="role" id="role" class="form-control">
            <?php
    foreach($roles as $role):
    ?>
            <option value="<?php echo $role['id']; ?>" <?php echo $user['role'] == $role['id'] ? 'selected' : '' ?>>
                <?php echo $role['role_name']?></option>
            <?php endforeach?>
        </select>

        <button type="submit" class="btn btn-primary"> Edit user </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';