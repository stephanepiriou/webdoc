<?php
namespace App\Controllers;


use App\Models\User;
use Core\View;

class Users extends Authenticated
{
    /**
     * Show the create user page
     *
     * @return void
     */
    public function newAction()
    {
        View::render('Users/create-user.php');
    }

    public function createAction(){
        $user = new User($_POST);

        if ($user->save()) {
            $this->redirect('/users/create-user-success');
         } else {
            View::render('Users/create-user.php', [
                'user' => $user
            ]);
        }
    }

    /**
     *
     */
    public function createUserSuccessAction()
    {
        View::render('Users/create-user-success.php');
    }



    public function showAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}