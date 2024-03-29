<?php 

/**
 * 
 *  Front Controller
 * 
 * echo "Requested Query = " . $_SERVER['QUERY_STRING'];
 */

 //require '../App/Controllers/Posts.php';
 //require '../Core/Router.php';

 require_once dirname(__DIR__) . "/vendor/Twig/lib/Twig/Autoloader.php";
 Twig_Autoloader::register();

spl_autoload_register(function($class){
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_readable($file)){
        require $file;
    }
});

 $router = new Core\Router();
 //echo get_class($router);

 $router->add('', ['controller' => 'Home', 'action' => 'index']);
 $router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
 $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
 //$router->add('{controller}/{action}');
 $router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
 //$router->add('{controller}/{id:\d+}/{action}');
 //echo '<pre>', print_r($router->getRoutes());

 /*
 $url = $_SERVER['QUERY_STRING'];
 if($router->match($url)){
    echo '<pre>', htmlspecialchars(print_r($router->getRoutes(), 1));
    echo '<pre>', print_r($router->getParams());
 }else{
     echo $url . ' Not Found';
 }
 */

$router->dispatch($_SERVER['QUERY_STRING']);