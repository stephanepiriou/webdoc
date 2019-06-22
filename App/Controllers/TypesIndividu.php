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

    /**
     * Call the search form
     * @throws \Exception
     */
    public function searchAction(){
        View::render('TypesIndividu/search-type-individu.php');
    }

    /**
     * Call and handles the list results of the search form
     * @throws \Exception
     */
    public function listAction(){
        $subTypeIndividuName = substr($_POST['inputTypeIndividuName'], 0, 3);
        $typesIndividuAsJson = TypeIndividu::getListSubAsJson($subTypeIndividuName);
        View::render('TypesIndividu/list-types-individu.php', [
            'typesIndividuAsJson' => $typesIndividuAsJson
        ]);
    }


    public function showAction(){
        $typeIndividuId = $_POST['typesIndividuId'];
        $typeIndividu = TypeIndividu::getById($typeIndividuId);
        View::render('TypesIndividu/show-type-individu.php', [
            'typeIndividu' => $typeIndividu
        ]);
    }

    public function updateAction(){
        $typeIndividu = new TypeIndividu($_POST);

        if($typeIndividu->update() === true){
            $this->redirect('/types-individu/update-type-individu-success');
        }else{
            View::render('TypesIndividu/show-type-individu.php', [
                'typeIndividu' => $typeIndividu,
            ]);
        }
    }

    /**
     * Redirect to update-type-individu-success after update Action
     */
    public function updateTypeIndividuSuccessAction()
    {
        View::render('TypesIndividu/update-type-individu-success.php');
    }

    public function deleteAction(){
        $id = $_POST['id'];
        if(TypeIndividu::delete($id) === true){
            View::render('TypesIndividu/delete-type-individu-success.php');
        }else{
            View::render('TypesIndividu/delete-type-individu-faillure.php');
        }
    }
}