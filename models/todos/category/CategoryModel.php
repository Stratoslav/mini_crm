<?php

namespace models\todos\category;

use models\Database;
use SplMaxHeap;

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $res = $this->db->query("SELECT 1 FROM `todo_category` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $todoCategoriesTableQuery = $this->db->query("CREATE TABLE IF NOT EXISTS `todo_category` (
             `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             `title` VARCHAR(255) NOT NULL,
             `description` TEXT,
             `usability` TINYINT DEFAULT 1,
             `user` INT NOT NULL,
             FOREIGN KEY (user) REFERENCES `users`(id) ON DELETE CASCADE
        )");

        try {
            $this->db->exec($todoCategoriesTableQuery);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function getAllCategories()
    {


        $stmt = $this->db->prepare("SELECT * FROM `todo_category`");
        try {
            $stmt->execute();
            $todo_category = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $todo_category;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function getCategory($id)
    {
        try {

            $stmt = $this->db->prepare("SELECT * FROM `todo_category` WHERE `id` = ?");
            $stmt->execute([$id]);
            $category = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $category ? $category : false;
        } catch (\PDOException $e) {

            return false;
        }
    }
    public function createCategory($title, $description, $user)
    {

        try {

            $stmt = $this->db->prepare("INSERT INTO `todo_category`  (title, description, user) VALUES (?,?, ?)");

            $stmt->execute([$title, $description, $user]);
            header("Location: /todos/category");
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function updateCategory($id, $title, $description, $usability)
    {
        $stmt = $this->db->prepare("UPDATE `todo_category` SET  title = ? , description = ?, usability = ? WHERE id = ?");

        try {



            $stmt->execute([$title, $description, $usability, $id]);
            header("Location: /todos/category");
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function deleteCategory($id)
    {
        $stmt = $this->db->prepare("DELETE FROM `todo_category` WHERE id = ?");

        try {
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
