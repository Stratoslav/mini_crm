<?php
$title = "page list";

ob_start();
?>

<section class="pages">
    <h1>Page List</h1>
    <a href="/pages/create" class="btn btn-success">Create page</a>
    <table>
        <thead>
            <tr>
                <th class="col">Id</th>
                <th class="col">Title</th>
                <th class="col">Slug</th>
                <th class="col">Role</th>
                <th class="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pages as $page) : ?>
                <tr class="page-tr">
                    <th scope="row"><?php echo $page['id'] ?></th>
                    <td> <?php echo $page['title'] ?></td>
                    <td> <?php echo $page['slug'] ?></td>
                    <td> <?php echo $page['role'] ?></td>
                    <td>
                        <a href="/pages/edit/<?= $page['id'] ?>" class="btn btn-primary">Edit</a>

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
