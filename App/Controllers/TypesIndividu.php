<?php
/**
 * File for TypesIndividu class
 * @package App\Controllers
 * @filesource
 */
namespace App\Controllers;

use App\Models\TypeIndividu;
use App\Models\Individu;
use Core\View;
use Core\Logger;
use App\Config;
use function var_dump;

/**
 * Class TypesIndividu
 * Control the TypeIndividu domain of the application
 * @package App\Controllers
 */
class TypesIndividu extends Authenticated
{

    /**
     * LOG_MODE
     */
    const LOG_MODE = Logger::DEBUG;

    /**
     * Redirect to individu type creation view
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            View::render('TypesIndividu/create-type-individu.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle creation of typeindividu
     * @return void
     * @throws \Exception
     */
    public function createAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            $typeIndividu = new TypeIndividu($_POST);
            $saved = $typeIndividu->save();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/CREATE :: $typeIndividu: '.(string) $typeIndividu.'; $saved: '.$saved);
            if ($saved) {
                $this->redirect('/types-individu/create-type-individu-success');
            } else {
                View::render('TypesIndividu/create-type-individu.php', [
                    'typeIndividu' => $typeIndividu
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Redirect to create-type-individu-success
     * @return void
     */
    public function createTypeIndividuSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            View::render('TypesIndividu/create-type-individu-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Call the search form
     * @return void
     */
    public function searchAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            View::render('TypesIndividu/search-type-individu.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Call and handles the list results of the search form
     * @return void
     */
    public function listAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            $subTypeIndividuName = substr($_POST['inputTypeIndividuName'], 0, 3);
            $typesIndividuAsJson = TypeIndividu::getListSubAsJson($subTypeIndividuName);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/LIST :: $subTypeIndividuName: '.$subTypeIndividuName.'; $typesIndividuAsJson: '.$typesIndividuAsJson);
            View::render('TypesIndividu/list-types-individu.php', [
                'typesIndividuAsJson' => $typesIndividuAsJson
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle show-type-individu.php view
     * @return void
     */
    public function showAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            $typeIndividuId = $_POST['typesIndividuId'];
            $typeIndividu = TypeIndividu::getById($typeIndividuId);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/SHOW :: $typeIndividuId: '.$typeIndividuId.'; $typeIndividu: '.(string) $typeIndividu);
            View::render('TypesIndividu/show-type-individu.php', [
                'typeIndividu' => $typeIndividu
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle database update operation view and redirect according to result of operation
     * @return void
     */
    public function updateAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            $typeIndividu = new TypeIndividu($_POST);
            $updated = $typeIndividu->update();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/UPDATE :: $updated: '.$updated.'; $typeIndividu: '.(string) $typeIndividu);
            if( $updated === true){
                $this->redirect('/types-individu/update-type-individu-success');
            }else{
                View::render('TypesIndividu/show-type-individu.php', [
                    'typeIndividu' => $typeIndividu,
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Redirect to update-type-individu-success after update Action
     * @return void
     */
    public function updateTypeIndividuSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            View::render('TypesIndividu/update-type-individu-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Call databate delete operation and redirect according to result of operation
     * @return void
     */
    public function deleteAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            $id = $_POST['id'];
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/DELETE :: $id: '.$id);
            if(!Individu::checkIndividuBeforeTypeIndividuDelete($id)){
                $deleted = TypeIndividu::delete($id);
                $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/DELETE :: $deleted: '.$deleted);
                if($deleted === true){
                    View::render('TypesIndividu/delete-type-individu-success.php');
                }else{
                    View::render('TypesIndividu/delete-type-individu-faillure.php');
                }
            }else{
                $logger->writeLog('IN CONTROLLER TYPESIDIVIDU/DELETE :: Still an Individu with this typeindividu type');
                View::render('TypesIndividu/delete-type-individu-faillure.php');

            }
        }else{
            View::render('Default/no-permission.php');
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