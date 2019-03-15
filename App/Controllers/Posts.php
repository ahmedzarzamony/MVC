<?php 

namespace App\Controllers;

class Posts extends \Core\Controller
{
    public function index()
    {
        echo "Posts - index <hr>";
        echo '<pre>', htmlspecialchars(print_r($_GET, 1));
    }

    public function addNew()
    {
        echo "Posts - add New";
    }

    public function edit()
    {
        echo '<pre>', print_r($this->route_params, 1);
    }
}