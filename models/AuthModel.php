<?php

namespace models;


class AuthModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $res = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
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
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function registration($username, $email, $password)
    {
        $created_at = date('Y-m-d H:i:s');

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, created_at) VALUES ( ?,?,?,?)");
        try {
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_BCRYPT), $created_at]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function login($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email = ? LIMIT 1`");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (\PDOException $e) {

            return false;
        }
    }
    public function findByEmail($email)
    {

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }
}
