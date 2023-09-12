<?php

namespace models;

use models\PageModel;

class CheckModel
{
    private $userRole;

    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }



    public function getCurrentUrlSlug()
    {
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parsed_url = parse_url($url);
        $path = $parsed_url['path'];
        $pathWithoutMain = str_replace(APP_MAIN_PATH, "", $path);
        $segment = explode('/', ltrim($pathWithoutMain, '/'));
        $firstToSegments = array_slice($segment, 0, 2);
        $slug = implode('/', $firstToSegments);
        return $slug;
    }
    public function requirePermission()
    {

        $slug = $this->getCurrentUrlSlug();

        if (!$this->checkPermission($slug)) {
            header("Location: /");
            return;
        }
    }

    public function checkPermission($slug)
    {
        $pageModel = new PageModel();
        $page = $pageModel->findBySlug($slug);
        if (!$page) {
            return  false;
        }
        $allowedUser = explode(",", $page['role']);
        if (isset($_SESSION['role']) && in_array($this->userRole, $allowedUser)) {
            return true;
        } else {
            return false;
        }
    }
    public function isCurrentUserRole($role)
    {
        return $this->userRole =   $role;
    }
}
