<?php


namespace App\Controllers;


use Core\View;

class Template extends \Core\Controller
{
    public function newAction(){
        View::render('Templates/template.php');
    }
}