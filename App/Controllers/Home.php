<?php

namespace App\Controllers;

use App\Auth;
use \Core\View;
use \App\Models\User;
use function unlink;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     * @return void
     */
    public function indexAction(){
    	// Check if there is already a user, and, in that case redirect to the right page
        if(User::isThereFirstUser()){
            $user = Auth::getUser();
            //If not logged redirect to login page
            if(empty($user)){
                View::render('Login/new.php');
            } else {
            	// If logged in, redirect to welcome message
                View::render('Home/index.php',[
                    'user' => $user,
                    'message_home' => 'Vous pouvez pouvez commencer à utiliser le programme en naviguant à l\'aide du menu.'
                ]);
            }
        }else{
        	// If no user exist, create an admin user with ,admin as name and password1 as password
	        // And redirect to home page with information message regarding password and mail.
            $user_array = array('email' => 'admin@admin.com', 'name' => 'admin','password' => 'password1');
            $user = new User($user_array);
            $user->save();
            View::render('Login/new.php',[
                'message_home' => "Veuillez vous connecter avec l'email (admin@admin.com) et le mot de passe (password1) fourni.\r\n\r\nVous allez être redirigé..."
            ]);
        }

    }
}
