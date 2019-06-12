<?php
namespace App\Controllers;

use App\Models\TypeIndividu;
use Core\View;

class TypesIndividu extends Authenticated
{
    /**
     * Redirect to individu type creation view
     * @throws \Exception
     */
    public function newAction(){
        View::render('TypesIndividu/create-type-individu.php');
    }

    /**
     * Handle creation of typeindividu
     * @throws \Exception
     */
    public function createAction(){
        $typeIndividu = new TypeIndividu($_POST);

        if ($typeIndividu->save()) {
            $this->redirect('/types-individu/create-type-individu-success');
        } else {
            View::render('TypesIndividu/create-type-individu.php', [
                'typeIndividu' => $typeIndividu
            ]);
        }
    }

    /**
     * Redirect to create-type-individu-success
     */
    public function createTypeIndividuSuccessAction()
    {
        View::render('TypesIndividu/create-type-individu-success.php');
    }

    public function showAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}