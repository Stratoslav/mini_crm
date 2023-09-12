<?php
$title = "create user";

ob_start();
?>
<section class="create-user">
    <h1>Create User</h1>


    <form method="POST" action="/users/store">

        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input name="username" type="text" id="username" class="form-control" placeholder="enter the username">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="text" id="email" class="form-control" placeholder="enter the email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input name="password" type="text" id="password" class="form-control" placeholder="enter the password">
        </div>
        <div class="mb-3">
            <label for="confirm__password" class="form-label">Confirm Password</label>
            <input name="confirm__password" type="text" id="confirm__password" class="form-control"
                placeholder="confirm__password">
        </div>
        <button type="submit" class="btn btn-primary"> Create user </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';