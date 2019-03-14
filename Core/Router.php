<?php 

class Router
{
    protected $routes = [];
    protected $params;

    public function add($route, $params)
    {
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

        $rg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        if(preg_match($rg_exp, $url, $matches)){
            $params = [];
            foreach($matches as $key=>$match){
                if(is_string($key)){
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
    }
}