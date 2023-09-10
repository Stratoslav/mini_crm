<?php
namespace models;

use models\Database;
class User{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
        try{
            $res = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
            
        }catch(\PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $roleTableQuery = $this->db->query("CREATE TABLE IF NOT EXISTS `roles` (
             `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             `role_name` VARCHAR(255) NOT NULL,
             `role_description` TEXT
        )");

       $userTableQuery = $this->db->query("CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT   PRIMARY KEY ,
    `username` VARCHAR(255) NOT NULL,
     `email` VARCHAR(255) NOT NULL,
      `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
      `role` INT(11) NOT NULL DEFAULT 0,
    `password` VARCHAR(255) NOT NULL,
        `is_active` TINYINT(1) NOT NULL DEFAULT 1,
        `last_login` TIMESTAMP NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  
    -- FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
);
");
try {
                $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
  
            return true;
} catch(\PDOException $e){
            return false;
}
    }
    public function getAllUsers(){
        $users = $this->db->query("SELECT * FROM `users`");

        $usersList = [];
      
        while ($row = $users->fetch(\PDO::FETCH_ASSOC)){
            $usersList[] = $row;
        }
      
        return $usersList;  
    }
    public function createUser($data) {
       
        $username = $data['username'];
        $email = $data['email'];
        $role = $data['role'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
      
        $created_at = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES ( ?,  ?,?,?,?)");
        try{

        $stmt->execute([$username, $email, $password, $role,  $created_at]);
            header("Location: /users");
        return true;
        } catch(\PDOException $e){
            print_r($e);
            return false;   
        }
       
    }
    public function delete($id){
        try{
 $stmt = $this->db->prepare("DELETE FROM `users` WHERE id = ?");
            $stmt->execute([$id]);
               header("Location: /users");
            return true;
        }catch(\PDOException $e){
            return false;
        }
       
    }
    public function read($id){
        try{
  $stmt = $this->db->prepare("SELECT * FROM `users` WHERE id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user;
        } catch(\PDOException $e){
            return false;
        }
      
    
    }
    public function update($id, $data){
    
        $username = $data['username'];
          $email = $data['email'];
    $role = $data['role'];
try{
   $stmt = $this->db->prepare("UPDATE  `users` SET `username` = ?, `email` = ?, `role` = ?  WHERE `id` = ?");
            $stmt->execute([$username, $email, $role, $id]);
              header("Location: /users");
            return true;
}catch(\PDOException $e){
    return false;
}
 
}   
 }