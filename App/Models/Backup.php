<?php

namespace App\Models;

use Core\Model;
use PDO;

class Backup extends Model
{

    /**
     * Get Backup list as Json
     * @return false|string json oblect of list of backup currently savaed in the DB
     */
    public static function getBackupListAsJson(){
        $sql = 'SELECT *
                FROM backups;';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get Backup list as Json
     * @return false|string json oblect of list of backup currently savaed in the DB
     */
    public static function getBackupListAsArray(){
        $sql = 'SELECT *
                FROM backups;';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll();
        //$jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $array;
    }

    /**
     * Get current backup filename.
     * @param $id
     * @return mixed
     */
    public static function getBackupFileNameFromId($id){
        $sql = 'SELECT filename
                FROM backups
                WHERE id=:id;';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $filename = $stmt->fetchColumn();
        return $filename;
    }

    /**
     * Select current id of the last backup
     * @return mixed
     */
    public static function getLastIteration(){
        $sql = 'SELECT id
                FROM backups';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $id = $stmt->fetchColumn();
        return $id;
    }

    /**
     * Insert current backup filename in DB
     * @param $filename The filename of the backup
     */
    public static function createBackup($filename){
        $sql = 'INSERT 
                INTO backups (filename, date)
                VALUE (:filename, now() )';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function delateBackup($id){
        $sql = 'DELETE 
                FROM backups
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}