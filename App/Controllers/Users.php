<?php
namespace App\Controllers;


use App\Models\User;
use Core\View;

/**
 * Class Users
 * Control the Users domain
 * @package App\Controllers
 */
class Users extends Authenticated
{
    /**
     * Show the create user page
     * @return void
     */
    public function newAction(){
        View::render('Users/create-user.php');
    }

    /**
     * Create a user through User model and redirect according to result of the operation
     * @return void
     * @throws \Exception
     */
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
     * @return void
     */
    public function createUserSuccessAction(){
        View::render('Users/create-user-success.php');
    }

    /**
     * Handle user search form view
     * @return void
     */
    public function searchAction(){
        View::render('Users/search-user.php');
    }

    /**
     * Handle list result view
     * @return void
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
     * @return void
     */
    public function showAction(){
        $userId = $_POST['userId'];
        $user = User::findByID($userId);
        View::render('Users/show-user.php', [
            'user' => $user
        ]);
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     * @return void
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
     * @return void
     */
    public function updateUserSuccessAction(){
        View::render('Users/update-user-success.php');
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     * @return void
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