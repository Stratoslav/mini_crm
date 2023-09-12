<?php
namespace models;
class RolesModel{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
        try{
            $res = $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
            
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

try {
                $this->db->exec($roleTableQuery);
        
  
            return true;
} catch(\PDOException $e){
            return false;
}
    }
    public function getAllRoles(){
        
          
  $stmt = $this->db->prepare("SELECT * FROM `roles`");
      try{
            $stmt->execute( );
           $roles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $roles;
      } catch(\PDOException $e){
            return false;
      }
    }
    public function getRole($params) {
        try{
  $stmt = $this->db->prepare("SELECT * FROM `roles` WHERE `id` = ?");
        $stmt->execute([$params['id']]);
            $role = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $role ? $role : false;
           
    
        } catch(\PDOException $e){
           
            return false;   
        }
       
    }
    public function createRole($data){
         $roleName = $data['role_name'];
    $roleDescr = $data['role_description'];
       
        try{
 
  $stmt = $this->db->prepare("INSERT INTO `roles`  (role_name, role_description) VALUES (?,?)");
   
  $stmt->execute([$roleName, $roleDescr]);
   header("Location: /roles");
        return true;
        }catch(\PDOException $e){
            echo $e;
            return false;   
        }
      
          
    }
    public function updateRole($id, $roleName, $roleDescr){
       $stmt = $this->db->prepare("UPDATE `roles` SET  role_name = ? , role_description = ? WHERE id = ?");

        try{

           
 
        $stmt->execute([$roleName, $roleDescr, $id]);
            header("Location: /roles");
        return true;
        }catch(\PDOException $e){
            echo $e;
            return false;   
        }
      
          
    }
 }

 