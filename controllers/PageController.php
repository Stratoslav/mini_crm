<?php
// require_once './app/models/PageModel.php';


namespace controllers;

use models\PageModel;
class PageController {

    public function index(){
        $pagesModel = new PageModel();
        $pages = $pagesModel->getAllPages();
       
        include './app/views/pages/index.php';
    }
  
        public function create(){
      
       
        include './app/views/pages/create.php';
    }
    public function store(){
      
        if(isset($_POST['title']) && isset($_POST['slug'])){
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            if(empty($title) || empty($slug)){
                echo "Title and Slug fields required";
                return false;
           }
          
            $pagesModel = new PageModel();
      
             $pagesModel->createPage($title, $slug); 
        }
      
    }

    public function edit($params){
     $pageModel = new PageModel();
      $page =  $pageModel->getPage($params['id']);
if(!$page){
            echo 'Page not found';
            return;
}

           include './app/views/pages/edit.php';
    }
    public function update(){
        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['slug'])){
          
            $pageModel = new PageModel();
        $pageModel->updatePage($_POST['id'], $_POST['title'], $_POST['slug']);
        }
       
    }
    public function delete($params){
       
            $pageModel = new PageModel();
        $pageModel->deletePage($params['id']);
     
    }
}