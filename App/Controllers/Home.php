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
     *
     * @return void
     */
    public function indexAction(){
        if(User::isThereFirstUser()){
            $user = Auth::getUser();
            if(empty($user)){
                View::render('Login/new.php',[
                    'user' => $user,
                    'message_home' => 'Veuillez vous logger à l\'aide du menu de connexion.'
                ]);
            } else {
                View::render('Home/index.php',[
                    'user' => $user,
                    'message_home' => 'Vous pouvez pouvez commencer à utiliser le programme en naviguant à l\'aide du menu.'
                ]);
            }
        }else{
            $user_array = array('email' => 'admin@admin.com', 'password' => 'password1');
            $user = new User($user_array);
            $user->save();
            View::render('Home/index.php',[
                'message_home' => "Veuillez vous loggez à l'aide du menu de connexion avec l'email (admin@admin.com) et le mot de passe (password1) présent.\r\n\r\nVous allez être redirigé..."
            ]);
            sleep(6);
            View::render('Login/new.php', [
                'email' => $user_array['email'],
                'password' => $user_array['password']
            ]);
        }

    }
}
