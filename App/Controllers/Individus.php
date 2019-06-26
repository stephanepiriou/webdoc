<?php
namespace App\Controllers;

use Core\View;
use App\Models\Individu;
use App\Models\TypeIndividu;
use function var_dump;

class Individus extends Authenticated
{
    /**
     * @var $jsonListTypesIndividu TypeIndividu dropdown values in json format to be injected in the view
     */
    public $jsonListTypesIndividu;

    public function newAction(){
        $jsonListTypesIndividu = TypeIndividu::getListAsJson();
        View::render('Individus/create-individu.php', [
            'jsonListTypesIndividu' => $jsonListTypesIndividu
        ]);
    }

    /**
     * Handle creation of individu and redirect according to success or faillure
     * @throws \Exception
     */
    public function createAction(){
        $typeindividuid = TypeIndividu::getIndexFromName($_POST['typeindividu']);
        $_POST['typeindividuid']= $typeindividuid;
        $individu = new Individu($_POST);

        if ($individu->save()) {
            $this->redirect('/individus/create-individu-success');
        } else {
            $jsonListTypesIndividu = TypeIndividu::getListAsJson();
            View::render('Individus/create-individu.php', [
                'individu' => $individu,
                'jsonListTypesIndividu' => $jsonListTypesIndividu
            ]);
        }
    }

    /**
     * Redirect to create-individu-success
     */
    public function createIndividuSuccessAction(){
        View::render('Individus/create-individu-success.php');
    }

    /**
     * Redirect to search-individu.php view
     */
    public function searchAction(){
        View::render('Individus/search-individu.php');
    }

    /**
     * List all Individus objects corresponding to search term from search form
     */
    public function listAction(){
        $searchType = $_POST['dropdownSearchType'];

        if($searchType === 'matricule'){
            $individusAsJson = Individu::listByMatricule($_POST['inputSearchTerm']);
        }elseif ($searchType === 'nom'){
            $individusAsJson = Individu::listByName($_POST['inputSearchTerm']);
        }

        View::render('Individus/list-individus.php', [
            'individusAsJson' => $individusAsJson
        ]);
    }

    /**
     * Handle show-individu.php view
     */
    public function showAction(){
        $individuId = $_POST['individuId'];
        $individu = Individu::getById($individuId);
        $jsonListTypesIndividu = TypeIndividu::getListAsJson();
        $chosenTypeIndividu = TypeIndividu::getNameFromIndex($individu->typeindividuid);
        View::render('Individus/show-individu.php', [
            'individu' => $individu,
            'jsonListTypesIndividu' => $jsonListTypesIndividu,
            'chosenTypeIndividu' => $chosenTypeIndividu
        ]);
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     */
    public function updateAction(){
        $typeindividuid = TypeIndividu::getIndexFromName($_POST['typeindividu']);
        $_POST['typeindividuid']= $typeindividuid;
        $individu = new Individu($_POST);
        var_dump($individu);
        if($individu->update() === true){
            $this->redirect('/individus/update-individu-success');
        }else{
            View::render('Individus/show-individu.php', [
                'individu' => $individu
            ]);
        }
    }

    /**
     * Redirect to update-user-success after update Action
     */
    public function updateIndividuSuccessAction()
    {
        View::render('Individus/update-individu-success.php');
    }

    /**
     * Handle update of a user and redirect on specific view according to result of operation
     */
    public function deleteAction(){
        $id = $_POST['id'];
        if(Individu::delete($id) === true){
            View::render('Individus/delete-individu-success.php');
        }else{
            View::render('Individus/delete-individu-faillure.php');
        }
    }
}