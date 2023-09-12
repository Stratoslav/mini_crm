<?php
$title = "create to do category";

ob_start();
?>

<section class="create-role">
    <h1>Create to do category</h1>


    <form method="POST" action="/todos/category/store">

        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input name="title" type="text" id="title" class="form-control" placeholder="enter the title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input name="description" type="text" id="description" class="form-control" placeholder="enter the description">
        </div>


        <button type="submit" class="btn btn-primary"> Create to do category </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';
