<?php
$title = "Authorization";

ob_start();
?>
<section class="login">
    <h1>Authorization</h1>


    <form method="POST" action="/register/authenticate">


        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="text" id="email" class="form-control" placeholder="enter the email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input name="password" type="text" id="password" class="form-control" placeholder="enter the password">
        </div>

        <label for="remember">Remember me</label>
        <input name="remember" type="checkbox" id="remember" placeholder="remember">
        <button type="submit" class="btn btn-primary">Login</button>
        <p>Or register<a href="/register/registration">Register</a></p>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';
