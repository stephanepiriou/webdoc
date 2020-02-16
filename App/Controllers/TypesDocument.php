<?php
/**
 * File for TypesDocument class
 * @package App\Controllers
 * @filesource
 */
namespace App\Controllers;

use App\Models\TypeDocument;
use App\Models\Document;
use Core\View;
use Core\Logger;
use App\Config;
use function substr;
use function var_dump;

/**
 * Class TypesDocument
 * Controller Controlling the logic of document types domain
 * @package App\Controllers
 */
class TypesDocument extends Authenticated
{

    /**
     * LOG_MODE
     */
    const LOG_MODE=Logger::DEBUG;

    /**
     * Control /types-document/new
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            View::render('TypesDocument/create-type-document.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle creation of a document type
     * @return void
     * @throws \Exception
     */
    public function createAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            $typeDocument = new TypeDocument($_POST);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESDOCUMENT/CREATE :: $typeDocument: '.(string) $typeDocument);
            if ($typeDocument->save()) {
                $this->redirect('/types-document/create-type-document-success');
            } else {
                View::render('TypesDocument/create-type-document.php', [
                    'typeDocument' => $typeDocument
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Redirection after Type document creation
     * @return void
     */
    public function createTypeDocumentSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')) {
            View::render('TypesDocument/create-type-document-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Handle search view
     * @return void
     */
    public function searchAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            View::render('TypesDocument/search-type-document.php');
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
            $subTypeDocumentName = substr($_POST['inputTypeDocumentName'], 0, 3);
            $typesDocumentAsJson = TypeDocument::getListSubAsJson($subTypeDocumentName);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESDOCUMENT/LIST :: $subTypeDocumentName: '.json_encode($subTypeDocumentName).' ; $typesDocumentAsJson: '.$typesDocumentAsJson);
            View::render('TypesDocument/list-types-document.php', [
                'typesDocumentAsJson' => $typesDocumentAsJson
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
            $typeDocumentId = $_POST['typesDocumentId'];
            $typeDocument = TypeDocument::getById($typeDocumentId);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESDOCUMENT/SHOW :: $typeDocumentId: '.$typeDocumentId.' ; $typeDocument: '.(string) $typeDocument);
            View::render('TypesDocument/show-type-document.php', [
                'typeDocument' => $typeDocument
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
            $typeDocument = new TypeDocument($_POST);
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESDOCUMENT/UPDATE :: $typeDocument: '.(string) $typeDocument);
            if($typeDocument->update() === true){
                $this->redirect('/types-document/update-type-document-success');
            }else{
                View::render('TypesDocument/show-type-document.php', [
                    'typeDocument' => $typeDocument,
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Redirect to update-type-document-success after update Action
     * @return void
     */
    public function updateTypeDocumentSuccessAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            View::render('TypesDocument/update-type-document-success.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Call databate delete operation and redirect according to result of operation
     * @return void
     * @throws \Exception
     */
    public function deleteAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            $id = $_POST['id'];
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER TYPESDOCUMENT/DELETE :: $id: '.$id);
            if(!Document::checkDocumentBeforeTypeDocumentDelete($id)){
                if(TypeDocument::delete($id) === true){
                    View::render('TypesDocument/delete-type-document-success.php');
                }else{
                    View::render('TypesDocument/delete-type-document-faillure.php');
                }
            }else{
                View::render('TypesDocument/delete-type-document-faillure.php');
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
        $is_valid = ! TypeDocument::nameExists($_GET['name']);
		header('Content-Type: application/json');
		echo json_encode($is_valid);
	}


}