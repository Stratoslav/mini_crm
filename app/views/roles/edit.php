<?php
$title = "edit role";

ob_start();
?>
<section class="edit-role">
    <h1>EDIT Role</h1>


    <form method="POST" action="/roles/update">
        <input type="hidden" name="id" value="<?php echo $role['id']?>">
        <div class="mb-3">
            <label for="role_name" class="form-label">role name</label>
            <input value="<?= $role['role_name']?>" name="role_name" type="text" id="role_name" class="form-control"
                placeholder="enter the role_name">
        </div>
        <div class="mb-3">
            <label for="role_description" class="form-label">role_description</label>
            <input value="<?= $role['role_description']?>" name="role_description" type="text" id="role_description"
                class="form-control" placeholder="enter the email">
        </div>
        <label for="role">Admin</label>

        <button type="submit" class="btn btn-primary"> Update role </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';