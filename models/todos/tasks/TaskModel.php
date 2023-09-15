<?php

namespace models\todos\tasks;

use models\Database;


class TaskModel
{
    private $db;
    private $userId;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
                $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        try {
            $res = $this->db->query("SELECT 1 FROM `todo_list` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $todoCategoriesTableQuery = $this->db->query("CREATE TABLE IF NOT EXISTS `todo_list` (
             `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             `title` VARCHAR(255) NOT NULL,
             `description` TEXT,
             `category_id` INT ,
             `user_id` INT NOT NULL,
             `status` ENUM('new', 'in_progress', 'completed', 'on_hold', 'cancelled') NOT NULL,
                `priority` ENUM('low', 'medium', 'hight', 'urgent') NOT NULL,
`assigned_to` INT,
`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`completed_at` DATETIME,
`finished_time` DATETIME,
`reminder_at` DATETIME,

             FOREIGN KEY (user_id) REFERENCES `users`(id) ON DELETE CASCADE,
                          FOREIGN KEY (assigned_to) REFERENCES `users`(id) ON DELETE SET NULL,

              FOREIGN KEY (category_id) REFERENCES `todo_category`(id) ON DELETE SET NULL
        )");

        try {
            $this->db->exec($todoCategoriesTableQuery);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function getAllTasks()
    {


        $stmt = $this->db->prepare("SELECT * FROM `todo_list` WHERE user_id = ?");
        try {
            $stmt->execute([$this->userId]);
            $todo_list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $todo_list;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function getTodoById($id)
    {
        try {

            $stmt = $this->db->prepare("SELECT * FROM `todo_list` WHERE `id` = ?");
            $stmt->execute([$id]);
            $task = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $task ? $task : false;
        } catch (\PDOException $e) {

            return false;
        }
    }
    public function createTask ($data)
    {

        try {

            $stmt = $this->db->prepare("INSERT INTO `todo_list`  (user_id, title, description, category_id, status,priority, finished_time) VALUES (?,?, ?, ?, ?, ?, ?)");

            $stmt->execute([$data['user_id'], $data['title'], $data['description'], $data['category_id'], $data['status'],$data['priority'], $data['finished_time']]);
            header("Location: /todos/tasks");
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