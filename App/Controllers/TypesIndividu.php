<?php
namespace App\Controllers;

use App\Models\TypeIndividu;
use Core\View;
use function var_dump;

/**
 * Class TypesIndividu
 * Control the TypeIndividu domain of the application
 * @package App\Controllers
 */
class TypesIndividu extends Authenticated
{
    /**
     * Redirect to individu type creation view
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        View::render('TypesIndividu/create-type-individu.php');
    }

    /**
     * Handle creation of typeindividu
     * @return void
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
     * @return void
     */
    public function createTypeIndividuSuccessAction(){
        View::render('TypesIndividu/create-type-individu-success.php');
    }

    /**
     * Call the search form
     * @return void
     */
    public function searchAction(){
        View::render('TypesIndividu/search-type-individu.php');
    }

    /**
     * Call and handles the list results of the search form
     * @return void
     */
    public function listAction(){
        $subTypeIndividuName = substr($_POST['inputTypeIndividuName'], 0, 3);
        $typesIndividuAsJson = TypeIndividu::getListSubAsJson($subTypeIndividuName);
        View::render('TypesIndividu/list-types-individu.php', [
            'typesIndividuAsJson' => $typesIndividuAsJson
        ]);
    }

    /**
     * Handle show-type-individu.php view
     * @return void
     */
    public function showAction(){
        $typeIndividuId = $_POST['typesIndividuId'];
        $typeIndividu = TypeIndividu::getById($typeIndividuId);
        View::render('TypesIndividu/show-type-individu.php', [
            'typeIndividu' => $typeIndividu
        ]);
    }

    /**
     * Handle database update operation view and redirect according to result of operation
     * @return void
     */
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
     * @return void
     */
    public function updateTypeIndividuSuccessAction(){
        View::render('TypesIndividu/update-type-individu-success.php');
    }

    /**
     * Call databate delete operation and redirect according to result of operation
     * @return void
     */
    public function deleteAction(){
        $id = $_POST['id'];
        if(TypeIndividu::delete($id) === true){
            View::render('TypesIndividu/delete-type-individu-success.php');
        }else{
            View::render('TypesIndividu/delete-type-individu-faillure.php');
        }
    }

	/**
	 * Ajax valifation checking the existence of a matricule
     * @return void
	 */
	public function validateNameAction(){
		$is_valid = ! TypeIndividu::nameExists($_GET['name']);
		header('Content-Type: application/json');
		echo json_encode($is_valid);
	}
}