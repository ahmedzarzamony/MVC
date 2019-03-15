<?php 

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
}