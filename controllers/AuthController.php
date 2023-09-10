<?php
// require_once './app/models/User.php';

namespace controllers;

use models\User;
use models\AuthModel;
class AuthController {

    public function registration(){
       
        include './app/views/users/register.php';
    }

    public function store(){
      
        if($_POST['username'] && $_POST['email'] && $_POST['password'] && $_POST['confirm__password']){
            $password = trim( $_POST['password']);
            $confirm__password = $_POST['confirm__password'];
            if($password !== $confirm__password){
                echo "Passwords don't compare";
                return;
            }
          
            $userModel = new AuthModel();
            $data = [
                'password' => $password,
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "role" => 1
            ];
             $userModel->registration( $data['username'], $data['email'], $data['password']); 
        }
    }

    public function login(){
 

           include './app/views/users/login.php';
    }
        public function authenticate(){
        $authModel = new AuthModel();
       
        if(isset($_POST['email']) && isset($_POST['password'])){
            $password = $_POST['password'];
           
            $email = $_POST['email'];
          
            $remember = isset($_POST['remember']) ? $_POST['remember'] : "";
            $user = $authModel->findByEmail($email);
           
            if($user && password_verify($password, $user['password'])){
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
if($remember == 'on'){
                    setcookie("user_email", $email, time() + (7 * 24 * 60 * 60), '/');
                     setcookie("user_password", $password, time() + (7 * 24 * 60 * 60), '/');
}
                header("Location: /");
            }else{
                echo "Dont rigth password";
            }
        }
    }
        public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
    }

}