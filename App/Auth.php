<?php
/**
 * File for Auth class
 * @package App
 * @filesource
 */

namespace App;

use App\Models\RememberedLogin;
use App\Models\User;
use function setcookie;

/**
 * Class Auth Authentication
 * @package App
 */
class Auth
{
    /**
     * Login the user
     *
     * @param $current_user
     * @param $remember_me remember the login if true
     * @return void
     */
    public static function login($current_user, $remember_me){
        session_regenerate_id(true);
        $_SESSION['user_id'] = $current_user->id;
        $_SESSION['current_user'] = $current_user;

        // remember_me functionality
        if ($remember_me){
            // If rememberLogin function return true
            if($current_user->rememberLogin()){
                setcookie('remember_me', $current_user->remember_token, $current_user->expiry_timestamp, '/');
            }
        }
    }

    /**
     * Logout the user
     * @return void
     */
    public static function logout(){
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        // Finally, destroy the session.
        session_destroy();
        static::forgetLogin();
    }

    /**
     * Remember requested page
     *
     * @return void
     */
    public static function rememberRequestedPage(){
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    /**
     * Return the requested page before login.
     *
     * @return string Return the requested page before login
     */
    public static function getReturnToPage(){
        return $_SESSION['return_to'] ?? '/';
    }

    /**
     * Get the current logged in user. From the session or the remember me cookie.
     *
     * @return mixed The user model or null if not logged in.
     */
    public static function getUser(){
        if (isset($_SESSION['user_id'])){
            return User::findByID($_SESSION['user_id']);
        }else{
            // Login with the remember cookie
            return static::loginFromRememberCookie();
        }
    }

    /**
     * Login the user froma remembered login cookie
     *
     * @return mixed The user model if login cookie found, otherwise null
     */
    protected static function loginFromRememberCookie(){
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie){
            $remembered_login = RememberedLogin::findByToken($cookie);

            if($remembered_login && !$remembered_login->hasExpired()){
                $current_user = $remembered_login->getUser();
                //$_SESSION['current_user'] = $current_user;
                static::login($current_user, false);
                return $current_user;
            }
        }
    }

    /**
     * Forget the rememberd login, if present
     * @return void
     */
    protected static function forgetLogin(){
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie){
            $remembered_login = RememberedLogin::findByToken($cookie);
            if($remembered_login){
                $remembered_login->delete();
            }
            setcookie('remember_me', '', time()-3600); //Set to expire in the past
        }
    }
}