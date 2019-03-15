<?php 

namespace App\Controllers;

class Posts extends \Core\Controller
{
    public function indexAction()
    {
        echo "Posts - index <hr>";
        echo '<pre>', htmlspecialchars(print_r($_GET, 1));
    }

    public function NewAction()
    {
        echo "Posts - add New";
    }

    public function editAction()
    {
        echo '<pre>', print_r($this->route_params, 1);
    }
}