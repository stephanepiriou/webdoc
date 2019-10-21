<?php
/**
 * File for Login class
 * @package App\Controllers
 * @filesource
 */
namespace App\Controllers;

use App\Auth;
use App\Flash;
use \Core\View;
use \App\Models\User;
use function session_regenerate_id;

/**
 * Login controller
 * @package App\Controller
 */
class Login extends \Core\Controller
{

    /**
     * Show the login page
     * @return void
     */
    public function newAction(){
        View::render('Login/new.php');
    }

    /**
     * Log in a user
     * @return void
     */
    public function createAction(){
        $current_user = User::authenticate($_POST['email'], $_POST['password']);
        $remember_me = isset($_POST['remember_me']);

        if ($current_user) {
            Auth::login($current_user, $remember_me);

            Flash::addMessage('Login successful');
            $this->redirect(Auth::getReturnToPage());
        } else {
            Flash::addMessage('Login unsucessful. Please try again.', Flash::WARNING);
            View::render('Login/new.php', [
                'email' => $_POST['email'],
                'remember_me' => $remember_me
            ]);
        }
    }

    /**
     * Logout a user
     * @return void
     */
    public function destroyAction(){
        Auth::logout();
        $this->redirect('/login/show-logout-message');
    }

    /**
     * Show a logout flash message and redirect to the homepage. Necessary to use the flash message
     * as the use the session varianble and at the end of the logout method (destroyAction) the session is
     * destroyed so a new action need to be called in order to use the session.
     */
    public function showLogoutMessageAction(){
        Flash::addMessage('You have been logout');
        //View::render('Login/new.php');
        $this->redirect('/login');
    }

}
