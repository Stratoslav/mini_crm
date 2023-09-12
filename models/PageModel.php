<?php

namespace models;

class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $res = $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (\PDOException $e) {
            echo $e;
            $this->createTable();
        }
    }

    public function createTable()
    {
        $pageTableQuery = $this->db->query("CREATE TABLE IF NOT EXISTS `pages` (
             `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             `title` VARCHAR(255) NOT NULL,
             `slug` VARCHAR(255) NOT NULL,
                `role` VARCHAR(255) NOT NULL,
             `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        try {
            $this->db->exec($pageTableQuery);


            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function getAllPages()
    {


        $stmt = $this->db->prepare("SELECT * FROM `pages`");
        try {
            $stmt->execute();
            $pages = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $pages;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function getPage($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `pages` WHERE `id` = ?");
            $stmt->execute([$id]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function createPage($title, $slug, $roles)
    {
        $title = trim($title);
        $slug = trim($slug);

        try {

            $stmt = $this->db->prepare("INSERT INTO `pages`  (title, slug, role) VALUES (?,?, ?)");

            $stmt->execute([$title, $slug, $roles]);
            header("Location: /pages");
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function updatePage($id, $title, $slug, $roles)
    {
        $stmt = $this->db->prepare("UPDATE `pages` SET  title = ? , slug = ?, role = ? WHERE id = ?");
        try {
            tt($roles);
            $stmt->execute([$title, $slug, $roles, $id]);
            header("Location: /pages");
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function deletePage($id)
    {
        $stmt = $this->db->prepare("DELETE FROM `pages` WHERE id = ?");
        try {
            $stmt->execute([$id]);
            header("Location: /pages");
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function findBySlug($slug)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `pages` WHERE `slug` = ?");
            $stmt->execute([$slug]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }
}
