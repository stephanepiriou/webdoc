<?php
namespace App\Controllers;


use Core\View;

class Users extends Authenticated
{
    /**
     * Show the signup page
     *
     * @return void
     */
    public function newAction()
    {
        View::render('Users/create-user.php');
    }

    public function createAction(){

    }

    public function showAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}