<?php


namespace App\Controllers;

use App\Auth;
use App\Models\User;
use Core\View;

/**
 * Items controller (example of restricted area by log in)
 *
 * @package App\Controllers
 */
class Items extends Authenticated
{

    /**
     * Items index
     *
     * @throws \Exception
     * @return void
     */
    public function indexAction(){
        View::render('Items/index.php');
    }


    /**
     * Add new item
     *
     * @return void
     */
    public function newAction(){
        echo 'New action';
    }

    /**
     * Show an item
     *
     * @return void
     */
    public function showAction(){
        echo 'Show action';
    }
}