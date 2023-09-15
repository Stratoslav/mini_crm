<?php
// require_once './app/models/Roles.php';

namespace controllers\todos\tasks;

use models\todos\tasks\TaskModel;
use models\todos\category\CategoryModel;
use models\CheckModel;

class TaskController
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
        $todoTaskModel = new TaskModel();
        $tasks = $todoTaskModel->getAllTasks();

        include './app/views/todos/tasks/index.php';
    }

    public function create()
    {
         $this->check->requirePermission();
 $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();

       
        include './app/views/todos/tasks/create.php';
    }
    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) && isset($_POST['finish_date']) && isset($_POST['category_id']) && isset($_POST['description'])) {
          
          

            if (empty($_POST['title']) || empty($_POST['description'])) {
                echo "Title is required";
                return false;
            }
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'finished_time' => $_POST['finish_date'],
                'category_id' => $_POST['category_id'],
                'user_id' =>   $_SESSION['user_id'] ? $_SESSION['user_id'] : 0,
                'status' => 'new',
                'priority' => 'low'
            ];
           
            $taskModel = new TaskModel();

            $taskModel->createTask($data);
        }
    }

    public function edit($params)
    {
        $this->check->requirePermission();
        $todoCategoryModel = new CategoryModel();
        $category =  $todoCategoryModel->getCategory($params['id']);
        if (!$category) {
            echo 'Role not found';
            return;
        }

        include './app/views/todos/category/edit.php';
    }
    public function update($params)
    {
        $this->check->requirePermission();

        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['usability'])) {
            echo "WORK";
            $roleModel = new CategoryModel();
            $roleModel->updateCategory($_POST['id'], $_POST['title'], $_POST['description'], $_POST['usability']);
        }
    }
    public function delete($params)
    {
        $this->check->requirePermission();
        $userModel = new CategoryModel();
        $userModel->deleteCategory($params['id']);
    }
}