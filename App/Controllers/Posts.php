<?php 

namespace App\Controllers;

class Posts
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
}