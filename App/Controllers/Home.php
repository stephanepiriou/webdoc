<?php

namespace App\Controllers;

use App\Auth;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction(){
        View::render('Home/index.php',[
            'user' => Auth::getUser()
        ]);
    }
}
