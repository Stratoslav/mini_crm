<?php
namespace app;

use controllers\HomeController;
use controllers\UserController;
use controllers\PageController;
use controllers\RolesController;
use controllers\AuthController;

class Router
{

    private $routes = [
      
        '/^\/'  . "\/?$/" => ['controller' => 'HomeController', 'action' => 'index'],
           "/^\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/" => ['controller' => 'UserController'],
             "/^\/roles(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/" => ['controller' => 'RolesController'],
                 "/^\/pages(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/" => ['controller' => 'PageController'],
                  "/^\/register(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/" => ['controller' => 'AuthController'],
                
    ];

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;
      
        foreach ($this->routes as $pattern => $route) {
       
            if (preg_match($pattern, $uri, $matches)) {
                print_r("EVERYTHING WORKS PROPERTY");
                $controller = 'controllers\\' . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                break;
            }
        }

        if (!$controller) {
            http_response_code(404);
            echo 'Page not found';
            return;
        }

        $instanceController = new $controller();
        if (!method_exists($instanceController,  $action)) {
            http_response_code(404);
            echo 'Page not found v';
            return;
        }

        call_user_func_array([$instanceController, $action], [$params]);
    }

   
}