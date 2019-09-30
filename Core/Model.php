<?php
/**
 * File for base Model class
 * @package Core
 * @filesource
 */

namespace Core;

use App\Config;

use PDO;
use PDOException;

/**
 * Class Model : Parent Class of the Model component of the app.
 * @package Core
 */
abstract class Model
{
    /**
     * Static function allowing the connection to the database to use in children
     * @return PDO|null
     */
    static function getDB(){
        static $db = null;

        if ($db === null){
            $dsn = 'mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $db->exec('SET NAMES utf8');
            //Throw an exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }

        return $db;
    }

}