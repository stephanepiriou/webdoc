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
     * @deprecated
     * Instanciate the Backup helper class, and refresh the Backups/index.php view
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
     * Called by Ajax request.
     * Instanciate the Backup helper class, and send relevant data back to view to update
     * with relevant information regarding operation and backup info
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

            // Incredibly, it's enough to create a well formed json object. :)
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