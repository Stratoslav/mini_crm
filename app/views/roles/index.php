<?php
$title = "role list";

ob_start();
?>
<section class="roles">
    <h1>Role List</h1>
    <a href="/roles/create" class="btn btn-success">Create role</a>
    <table>
        <thead>
            <tr>
                <th class="col">#</th>
                <th class="col">Name</th>
                <th class="col">Description</th>
                <th class="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach($roles as $role): ?>
            <tr class="role-tr">
                <th scope="row"><?php echo $role['id']?></th>
                <td> <?php echo $role['role_name']?></td>
                <td> <?php echo $role['role_description']?></td>
                <td>
                    <a href="/roles/edit/<?= $role['id'] ?>" class="btn btn-primary">Edit</a>

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