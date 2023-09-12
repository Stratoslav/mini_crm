<?php
$title = "create page";

ob_start();
?>
<section class="create-page">
    <h1>Create page</h1>


    <form method="POST" action="/pages/store">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" id="title" class="form-control" placeholder="enter the title...">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input name="slug" type="text" id="slug" class="form-control" placeholder="enter the slug...">
        </div>
        <div class="mb-3">
            <?php foreach ($roles as $role) : ?>
                <input class="form-check-input" name="roles[]" type="checkbox" value="<?php echo $role['id'] ?>" id="roles" class="form-control">
                <label for="roles" class="form-check-label"><?php echo $role['role_name'] ?></label>
            <?php endforeach ?>
        </div>

        <button type="submit" class="btn btn-primary"> Create page </button>
    </form>
</section>
<?php $content = ob_get_clean();

include './app/views/layout.php';
