<?php
$title = "Edit To Do Category";

ob_start();
?>
<section class="edit-role">
    <h1>Edit To Do Category</h1>


    <form method="POST" action="/todos/category/update">
        <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input value="<?= $category['title'] ?>" name="title" type="text" id="title" class="form-control" placeholder="enter the title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input value="<?= $category['description'] ?>" name="description" type="text" id="description" class="form-control" placeholder="enter the description">
        </div>

        <div class="mb-3">

            <input value="<?= $category['usability'] ?>" name="usability" type="checkbox" value="1" <?php echo $category['usability'] ? 'checked' : '' ?> id="usability" class="form-check-input" placeholder="enter the usability">
            <label for="usability" class="form-label">usability</label>
        </div>
        <button type="submit" class="btn btn-primary"> Update to do category </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';
