<?php
$title = "edit page";

ob_start();
?>
<section class="edit-page">
    <h1>Edit Page</h1>


    <form method="POST" action="/pages/update">
        <input type="hidden" name="id" value="<?php echo $page['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input value="<?= $page['title'] ?>" name="title" type="text" id="title" class="form-control" placeholder="enter the title">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">slug</label>
            <input value="<?= $page['slug'] ?>" name="slug" type="text" id="slug" class="form-control" placeholder="enter the slug">
        </div>
        <div class="mb-3">
            <?php $page_roles = explode(",", $page['role']);
            tt($page_roles); ?>
            <?php foreach ($roles as $role) : ?>
                <input class="form-check-input" name="roles[]" type="checkbox" value="<?php echo $role['id'] ?>" id="roles" class="form-control" <?php echo in_array($role['id'], $page_roles) ? 'checked' : '' ?>>
                <label for="roles" class="form-check-label"><?php echo $role['role_name'] ?></label>
            <?php endforeach ?>
        </div>

        <button type="submit" class="btn btn-primary"> Update page </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';
