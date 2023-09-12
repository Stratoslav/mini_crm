<?php



namespace controllers;

use models\CheckModel;
use models\PageModel;
use models\RolesModel;

class PageController
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
        $pagesModel = new PageModel();
        $pages = $pagesModel->getAllPages();



        include './app/views/pages/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        $rolesModel = new RolesModel();
        $roles = $rolesModel->getAllRoles();

        include './app/views/pages/create.php';
    }
    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $roles = implode(",", $_POST['roles']);
            if (empty($title) || empty($slug) || empty($roles)) {
                echo "Title and Slug or roles fields required";
                return false;
            }

            $pagesModel = new PageModel();

            $pagesModel->createPage($title, $slug, $roles);
        }
    }

    public function edit($params)
    {
        // $this->check->getCurrentUrlSlug();
        $this->check->requirePermission();
        $rolesModel = new RolesModel();
        $roles =  $rolesModel->getAllRoles();

        $pageModel = new PageModel();
        $page =  $pageModel->getPage($params['id']);
        if (!$page) {
            echo 'Page not found';
            return;
        }

        include './app/views/pages/edit.php';
    }
    public function update()
    {
        $this->check->requirePermission();
        if (isset($_POST['id']) && isset($_POST['roles']) && isset($_POST['title']) && isset($_POST['slug'])) {
            $roles = implode(",", $_POST['roles']);
            $pageModel = new PageModel();
            $pageModel->updatePage($_POST['id'], $_POST['title'], $_POST['slug'], $roles);
        }
    }
    public function delete($params)
    {

        $this->check->requirePermission();
        $pageModel = new PageModel();
        $pageModel->deletePage($params['id']);
    }
}
