<?php 

namespace App\Controllers\Admin;

class User extends \Core\Controller
{

    public function indexAction()
    {
        echo "User - index";
    }

    protected function before()
    {
        // make sure the user is an admin
    }

    protected function after()
    {
        
    }
}