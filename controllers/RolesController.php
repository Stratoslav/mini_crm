<?php
// require_once './app/models/Roles.php';

namespace controllers;

use models\RolesModel;
class RolesController {

    public function index(){
        $rolesModel = new RolesModel();
        $roles = $rolesModel->getAllRoles();
      
        include './app/views/roles/index.php';
    }
  
        public function create(){
      
       
        include './app/views/roles/create.php';
    }
    public function store(){
      
        if(isset($_POST['role_name']) && isset($_POST['role_description'])){
           if(empty($_POST['role_name'])){
                echo "Role name is required";
                return false;
           }
          
            $rolesModel = new RolesModel();
            $data = [
              
                "role_name" => $_POST['role_name'],
                "role_description" => $_POST['role_description'],
            ];
             $rolesModel->createRole($data); 
        }
        // header("Location: index.php?page=roles");
    }

    public function edit($id){
     $roleModel = new RolesModel();
      $role =  $roleModel->getRole($id);
if(!$role){
            echo 'Role not found';
            return;
}

           include './app/views/roles/edit.php';
    }
    public function update(){
        if(isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])){
            
            $roleModel = new RolesModel();
        $roleModel->updateRole($_POST['id'], $_POST['role_name'], $_POST['role_description']);
        }
       
    }
}