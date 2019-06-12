<?php
namespace App\Controllers;

use Core\View;
use App\Models\Individu;
use App\Models\TypeIndividu;
use function var_dump;

class Individus extends Authenticated
{
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
            View::render('Individus/create-individu.php', [
                'individu' => $individu
            ]);
        }
    }

    /**
     * Redirect to create-individu-success
     */
    public function createIndividuSuccessAction(){
        View::render('Individus/create-individu-success.php');
    }

    public function showAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}