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


    public function searchAction(){
        View::render('Users/search-user.php');
    }

    public function listAction(){
        $subEmails = substr($_POST['inputEmail'], 0, 3);
        $emailsAsJson = User::getEmailListSubAsJson($subEmails);
        View::render('Users/list-users.php', [
            'emailsAsJson' => $emailsAsJson
        ]);
    }

    public function showAction(){
        $email = $_POST['userEmail'];
        var_dump($email);
        View::render('Users/show-user.php');
    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}