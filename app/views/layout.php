<?php

namespace app\views;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="/app/public/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <nav class=" navbar-c navbar-expand-lg ">
            <div class="container-fluid-c">
                <a class="navbar-link" href="/">crm_for_telegram</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link <?php echo isComparedUrl('/users')?>" href="<?= '/users' ?>">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isComparedUrl('/roles')?>" aria-current="page"
                                href="<?= '/roles' ?>">AllRoles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isComparedUrl('/pages')?>" href="/pages">Pages </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/register/registration">Register</a></li>
                                <li><a class="dropdown-item" href="/register/login">login</a></li>
                                <li><a class="dropdown-item" href="/register/logout">logout</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/pages">Pages </a></li>
                            </ul>
                        </li>
                        <hr />
                        <h4>To do</h4>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isComparedUrl('/todos/tasks')?>" href="/todos/tasks">Tasks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isComparedUrl('/todos/category')?>"
                                href="/todos/category">Category </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <?php echo $content ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>