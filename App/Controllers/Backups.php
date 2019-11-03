<?php


namespace App\Controllers;

use App\Backup;
use App\Config;
use Core\View;
use App\Models\Backup as ModelBackup;

class Backups extends Authenticated
{

    /**
     * Call the Backup page
     * @throws \Exception
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $jsonbackuplist = ModelBackup::getBackupListAsJson();
            View::render('Backups/index.php', [
                'jsonbackuplist' => $jsonbackuplist
            ]);
        }
    }

    /**
     * Instanciate the Backup helper class,  and refresh
     */
    public function createAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $backup = new Backup();
            $success = $backup->createBackup();
            $jsonbackuplist = ModelBackup::getBackupListAsJson();

            if($success){
                $message = 'Le backup a été créé !';
            }else {
                $message = 'Une erreur a empêché le backup d\'être créé !';
            }

            View::render('Backups/index.php', [
                'jsonbackuplist' => $jsonbackuplist,
                'message' => $message
            ]);
        }
    }

    /**
     * Same As createAction, but
     */
    public function createAjaxAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $backup = new Backup();
            $success = $backup->createBackup();
            $jsonbackuplist = ModelBackup::getBackupListAsJson();

            if($success){
                $message = 'Le backup a été créé !';
            }else {
                $message = 'Une erreur a empêché le backup d\'être créé !';
            }

            $data = '['.$jsonbackuplist.',"'.$message.'"]';
            header('Content-Type: application/json');
            echo $data;
        }
    }

    /**
     *
     */
    public function restoreAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('user_administration')) {
            $backup = new Backup();
            $success = $backup->restoreBackup();
            $jsonbackuplist = ModelBackup::getBackupListAsJson();

            if($success){
                $message = 'Le backup a été restauré !';
            }else {
                $message = 'Une erreur a empêché le backup d\'être restauré !';
            }

            View::render('Backups/index.php', [
                'jsonbackuplist' => $jsonbackuplist,
                'message' => $message
            ]);
        }
    }

}