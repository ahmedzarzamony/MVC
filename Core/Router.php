<?php 

namespace Core;

class Router
{
    protected $routes = [];
    protected $params;

    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // convert variables e.g {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // convert varaiables with custom reqular expressions e.g {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimmiters, and case insenstive flag
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        // foreach($this->routes as $router => $params){
        //     if($url == $router){
        //         $this->params = $params;
        //         return true;
        //     }
        // }
        // return false;

        //$rg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                //$params = [];
                foreach($matches as $key=>$match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);
        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($this->params['controller']);
            //$controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;
            if(class_exists($controller)){
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($this->params['action']);

                if(is_callable([$controller_object, $action])){
                    $controller_object->$action();
                }else{
                    echo $action . ' Method Not Found';
                }
            }else{
                echo $controller . ' Class Not Found';
            }
        }else{
            echo 'Route Not Matched';
        }
    }

    public function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    public function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps(($string)));
    }

    public function removeQueryStringVariables($url)
    {
        if($url != ''){
            $parts = explode('&', $url, 2);
            if(strpos($parts[0], '=') === false){
                $url = $parts[0];
            }else{
                $url = '';
            }
        }
        return $url;
    }

    public function getNamespace()
    {
        $namespace = "App\Controllers\\";
        if(array_key_exists('namespace', $this->params)){
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}