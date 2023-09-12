<?php
// require_once './app/models/User.php';
// require_once './app/models/Roles.php';

namespace controllers;

use models\User;
use models\RolesModel;
use models\CheckModel;

class UserController
{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
        $this->check  = new CheckModel($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();
        $userModel = new User();
        $users = $userModel->getAllUsers();


        include './app/views/users/index.php';
    }
    public function create()
    {
        $this->check->requirePermission();
        include './app/views/users/create.php';
    }
    public function store()
    {
        $this->check->requirePermission();
        if ($_POST['username'] && $_POST['email'] && $_POST['password'] && $_POST['confirm__password']) {
            $password = $_POST['password'];
            $confirm__password = $_POST['confirm__password'];
            if ($password !== $confirm__password) {
                echo "Passwords don't compare";
                return;
            }

            $userModel = new User();
            $data = [
                'password' =>  $password,
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "role" => 1
            ];
            $userModel->createUser($data);
        }
    }
    public function delete($params)
    {
        $this->check->requirePermission();
        $userModel = new User();
        $userModel->delete($params['id']);
    }
    public function edit($params)
    {

        $this->check->requirePermission();
        $userModel = new User();

        $user =  $userModel->read($params['id']);


        $rolesModel = new RolesModel();
        $roles =  $rolesModel->getAllRoles();

        include './app/views/users/edit.php';
    }
    public function update($params)
    {

        $this->check->requirePermission();

        if (isset($_POST['role'])) {
            $newRole = $_POST['role'];

            if ($this->check->isCurrentUserRole($newRole)) {

                header("Location: /register/logout");
                exit();
            }
        }
        $userModel = new User();
        $userModel->update($params['id'], $_POST);
    }
}
