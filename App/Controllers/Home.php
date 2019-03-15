<?php 

namespace App\Controllers;

class Home extends \Core\Controller
{
    protected function before()
    {
        echo "(Before)";
    }

    protected function after()
    {
        echo "(After)";
    }

    public function indexAction()
    {
        echo "Home - index";
    }
}