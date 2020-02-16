<?php
/**
 * File for Users class
 * @package App\Controllers
 * @filesource
 */
namespace App\Controllers;


use App\Models\User;
use App\Models\Role;
use Core\View;
use Core\Logger;
use App\Config;

/**
 * Class Users
 * Control the Users domain
 * @package App\Controllers
 */
class Users extends Authenticated
{
    /**
     * LOG_MODE
     */
    const LOG_MODE = Logger::DEBUG;

    /**
     * Show the create user page
     * @return void
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')){
            $roleNameListAsJson = Role::getNameListAsJson();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/NEW :: $roleNameListAsJson:'.$roleNameListAsJson);
            View::render('Users/create-user.php',[
                'roleNameListAsJson' => $roleNameListAsJson
            ]);
        }else {
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Create a user through User model and redirect according to result of the operation
     * @return void
     * @throws \Exception
     */
    public function createAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}

        if($current_user->hasPermission('user_administration')) {
            $user = new User($_POST);
            $saved = $user->save();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/CREATE :: $user: '.(string) $user.' ; $saved: '.$saved);
            if ($saved) {
                $this->redirect('/users/create-user-success');
            } else {
                $roleNameListAsJson = Role::getNameListAsJson();
                View::render('Users/create-user.php', [
                    'roleNameListAsJson' => $roleNameListAsJson,
                    'user' => $user
                ]);
            }
        }else {
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle user creation view
     * @return void
     */
    public function createUserSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            if (isset($_SESSION['current_user'])) {
                $current_user = $_SESSION['current_user'];
            } else {
                $current_user = '';
            }
            View::render('Users/create-user-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle user search form view
     * @return void
     */
    public function searchAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            View::render('Users/search-user.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle list result view
     * @return void
     */
    public function listAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $subEmails = substr($_POST['inputEmail'], 0, 3);
            $emailsAsJson = User::getEmailListSubAsJson($subEmails);

            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/LIST :: $subEmails: '.$subEmails.' ; $emailsAsJson: '.$emailsAsJson);

            View::render('Users/list-users.php', [
                'emailsAsJson' => $emailsAsJson
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle show-user.php
     * @return void
     */
    public function showAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $userId = $_POST['userId'];
            $roleId = User::getRoleId($userId);
            $roleNameListAsJson = Role::getNameListAsJson();
            $chosenRoleName = Role::getNameFromIndex($roleId);
            $user = User::findByID($userId);

            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/SHOW :: $userId: '.$userId.' ; $roleId: '.$roleId.' ; $roleNameListAsJson: '.$roleNameListAsJson.' ; $chosenRoleName: '.$chosenRoleName.' ; $user: '.(string) $user);
            View::render('Users/show-user.php', [
                'user' => $user,
                'roleNameListAsJson' => $roleNameListAsJson,
                'chosenRoleName' => $chosenRoleName,
                "chosenRoleId" => $roleId
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     * @return void
     */
    public function updateAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $user = new User($_POST);
            $updated = $user->update();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/UPDATE :: $user: '.(string) $user.' ; $updated: '.$updated);
            if($updated === true){
                $this->redirect('/users/update-user-success');
            }else{
                View::render('Users/show-user.php', [
                    'user' => $user,
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Redirect to update-user-success after update Action
     * @return void
     */
    public function updateUserSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            View::render('Users/update-user-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     * @return void
     */
    public function deleteAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $id = $_POST['id'];
            $deleted = User::delete($id);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER USERS/UPDATE :: $id: '.$id.' ; $deleted: '.$deleted);
            if($deleted === true){
                View::render('Users/delete-user-success.php');
            }else{
                View::render('Users/delete-user-faillure.php');
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }
}