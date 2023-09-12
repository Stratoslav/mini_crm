<?php
// require_once './app/models/Roles.php';

namespace controllers\todos\category;

use models\todos\category\CategoryModel;
use models\CheckModel;

class CategoryController
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
        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();

        include './app/views/todos/category/index.php';
    }

    public function create()
    {

        $this->check->requirePermission();
        include './app/views/todos/category/create.php';
    }
    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';

            if (empty($title) || empty($description)) {
                echo "Title and Description are required";
                return false;
            }

            $rolesModel = new CategoryModel();

            $rolesModel->createCategory($title, $description, $user);
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
