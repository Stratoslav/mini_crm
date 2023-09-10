<?php
// require_once './app/models/User.php';
// require_once './app/models/Roles.php';

namespace controllers;

use models\User;
use models\RolesModel;
class UserController {

    public function index(){
        $userModel = new User();
        $users = $userModel->getAllUsers();

    
        include './app/views/users/index.php';
    }
    public function create() {
    
     include './app/views/users/create.php';
    }
    public function store(){
  
        if($_POST['username'] && $_POST['email'] && $_POST['password'] && $_POST['confirm__password']){
            $password = $_POST['password'];
            $confirm__password = $_POST['confirm__password'];
            if($password !== $confirm__password){
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
    public function delete($params){
        $userModel = new User();
        $userModel->delete($params['id']);
        
    }
    public function edit($params){
     $userModel = new User();
       
      $user =  $userModel->read($params['id']);


        $rolesModel = new RolesModel();
      $roles =  $rolesModel->getAllRoles();

           include './app/views/users/edit.php';
    }
    public function update($params){
          $userModel = new User();
        $userModel->update($params['id'], $_POST);
    }
}