<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once "./config.php";
require_once "./autoload.php";

// require_once './app/models/Database.php';
// require_once './app/models/User.php';
// require_once './app/models/Auth.php';
// require_once './app/models/Roles.php';
// require_once './app/models/PageModel.php';
// require_once './app/controllers/auth.controller.php';
// require_once './app/controllers/user.controller.php';
// require_once './app/controllers/home.controller.php';
// require_once './app/controllers/page.controller.php';
// require_once './app/controllers/roles.controller.php';
// require_once './router.php';

$router = new app\Router();

$router->run();
