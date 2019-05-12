<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 5.4
 */
class Home extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        //echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::render('Home/index.php', [
            'name'    => 'Dave',
            'colours' => ['red', 'green', 'blue']
        ]);
    }

    public function tempAction(){
        View::render("Home/temp.php");
    }

    public function templateAction(){
        View::render("Home/template.php", [
            'title' => 'Title Template',
            'header' => 'Header Template',
            'titlepage' => 'Title Page Template',
            'mainpanel' => '<button id="thebutton">Click</button>',
            'bottomscript' => '$("#thebutton").click(function(){alert("coucou");});'
        ]);
    }
}
