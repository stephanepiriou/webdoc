<?php


namespace App\Controllers;


abstract class Authenticated extends \Core\Controller
{
    /**
     * Inherited function from base Controller.
     * Used for requiring login before page load.
     *
     * @return void
     */
    protected function before(){
        $this->requireLogin();
    }
}