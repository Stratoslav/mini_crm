<?php
$title = "create to do list";

ob_start();
?>

<section class="create-role">
    <h1>Create to do list</h1>


    <form method="POST" action="/todos/tasks/store">
        <div class="row">
            <div class="mb-3 col-12 col-md-12">
                <label for="title" class="form-label">title</label>
                <input name="title" type="text" id="title" class="form-control" placeholder="enter the title">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-md-12">
                <label for="description" class="form-label">description</label>
                <input name="description" type="text" id="description" class="form-control"
                    placeholder="enter the description">
            </div>
            <div class="mb-3 col-6 col-md-6">
                <label for="description" class="form-label">description</label>
                <select class="form-control" name="category_id" id="category_id">
                    <?php foreach($categories as $category):?>
                    <option value="<?php echo $category['id']?>"><?php echo $category['title']?></option>
                    <?php endforeach;?>
                </select>

            </div>
            <div class="mb-3 col-6 col-md-6">
                <label for="finish_date" class="form-label">Finish date</label>
                <input name="finish_date" type="datetime-local" id="finish_date" class="form-control">
            </div>
        </div>



        <button type="submit" class="btn btn-primary"> Create to do category </button>
    </form>
</section>

<?php $content = ob_get_clean();

include './app/views/layout.php';