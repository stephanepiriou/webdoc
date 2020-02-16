<?php


namespace App\Controllers;

use App\Collection;
use App\Models\Individu;
use Core\View;
use Core\Logger;
use App\Config;


/**
 * Class Collect
 * Handle the domain responsible for downloading the document
 * grouped par folder attribued to a particular develloper.
 * @package App\Controllers
 */
class Collect extends Authenticated
{
    /**
     * Handle the view from wich we can download the Zip
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            View::render('Collect/index.php');
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Controller called from the view containing the form to download the Zip Archivre
     * This method call the class Collection, responsible for the creation of the ZIP
     * archive and and initializing its download
     */
    public function collectAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            $collection = new Collection();
            $collection->createZip();
            $success = $collection->send();
            $logger = new Logger(Logger::DOWNLOAD, Config::LOG_ENABLED);
            if($success != false AND $success != 0){
                $logger->writeLog('IN CONTROLLER COLLECT/COLLECT FROM COLLECTION :: $collection->send(): '.$success.' bytes downloaded');
                $collection->deleteZip();
            }else {
                $logger->writeLog('IN CONTROLLER COLLECT/COLLECT FROM COLLECTION :: $collection->send(): false.');
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }
}