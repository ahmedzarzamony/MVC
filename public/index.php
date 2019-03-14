<?php 

/**
 * 
 *  Front Controller
 * 
 * echo "Requested Query = " . $_SERVER['QUERY_STRING'];
 */

 require '../Core/Router.php';

 $router = new Router();
 //echo get_class($router);

 $router->add('', ['controller' => 'Home', 'method' => 'index']);
 $router->add('posts', ['controller' => 'Posts', 'method' => 'index']);
 $router->add('posts/new', ['controller' => 'Posts', 'method' => 'new']);

 echo '<pre>', print_r($router->getRoutes());