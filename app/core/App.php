<?php

class App {

    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        $controllerName = ucfirst($url[0]) . 'Controller';
        $methodName = isset($url[1]) ? $url[1] : null;

        if(file_exists("./app/controllers/{$controllerName}.php")) {
            $this->controller = $controllerName;
            unset($url[0]);
        }

        require_once "./app/controllers/{$this->controller}.php";
        $this->controller = new $this->controller;

        if($methodName) {
            if(method_exists($this->controller, $methodName)) {
                $this->method  = $methodName;
                unset($url[1]);
            }
        }


        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller,$this->method], $this->params);
    }

    public function parseUrl() {
        global $Routes;
        if(isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'),FILTER_SANITIZE_URL));
        } else {
            $url =  ['/'];
        }
        // Check if the route is in $Routes
        if (!in_array($url[0], $Routes)) {
            http_response_code(404);
            die('Invalid route.');
        }
        return $url;
    }

}