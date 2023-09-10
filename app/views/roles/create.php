<?php
$title = "create role";

ob_start();
?>

<section class="create-role">
    <h1>Create role</h1>


    <form method="POST" action="/roles/store">

        <div class="mb-3">
            <label for="role_name" class="form-label">role name</label>
            <input name="role_name" type="text" id="role_name" class="form-control" placeholder="enter the role_name">
        </div>
        <div class="mb-3">
            <label for="role_description" class="form-label">Email</label>
            <input name="role_description" type="text" id="role_description" class="form-control"
                placeholder="enter the role_description">
        </div>


        <button type="submit" class="btn btn-primary"> Create role </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';