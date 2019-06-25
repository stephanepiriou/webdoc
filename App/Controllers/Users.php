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
     * Handle user creation view
     */
    public function createUserSuccessAction()
    {
        View::render('Users/create-user-success.php');
    }

    /**
     * Handle user search form view
     */
    public function searchAction(){
        View::render('Users/search-user.php');
    }

    /**
     * Handle list result view
     */
    public function listAction(){
        $subEmails = substr($_POST['inputEmail'], 0, 3);
        $emailsAsJson = User::getEmailListSubAsJson($subEmails);
        View::render('Users/list-users.php', [
            'emailsAsJson' => $emailsAsJson
        ]);
    }

    /**
     * Handle show-user.php
     */
    public function showAction(){
        $userId = $_POST['userId'];
        $user = User::findByID($userId);
        var_dump($user);
        View::render('Users/show-user.php', [
            'user' => $user
        ]);
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     */
    public function updateAction(){
        $user = new User($_POST);

        if($user->update() === true){
            $this->redirect('/users/update-user-success');
        }else{
            View::render('Users/show-user.php', [
                'user' => $user,
            ]);
        }
    }

    /**
     * Redirect to update-user-success after update Action
     */
    public function updateUserSuccessAction()
    {
        View::render('Users/update-user-success.php');
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     */
    public function deleteAction(){
        $id = $_POST['id'];
        if(User::delete($id) === true){
            View::render('Users/delete-user-success.php');
        }else{
            View::render('Users/delete-user-faillure.php');
        }
    }
}