<?php
$title = "To do Category";

ob_start();
?>
<section class="roles">
    <h1>To do Category</h1>
    <a href="/todos/category/create" class="btn btn-success">Create category</a>
    <table>
        <thead>
            <tr>
                <th class="col">id</th>
                <th class="col">Title</th>
                <th class="col">Description</th>
                <th class="col">usability</th>
                <th class="col">user id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $category) : ?>
                <tr class="role-tr">
                    <th scope="row"><?php echo $category['id'] ?></th>
                    <td> <?php echo $category['title'] ?></td>
                    <td> <?php echo $category['description'] ?></td>
                    <td> <?php echo $category['usability'] ?></td>
                    <td> <?php echo $category['user'] ?></td>
                    <td>
                        <a href="/todos/category/edit/<?= $category['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/todos/category/delete/<?= $category['id'] ?>" class="btn btn-primary">Delete</a>

                    </td>
                </tr>

            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</section>


<?php $content = ob_get_clean();

include './app/views/layout.php';
