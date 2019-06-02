<?php
namespace App\Models;

use Core\Model;
use PDOException;
use PDO;

class Post extends Model
{
    /**
     * Get all the Posts in an associative array
     *
     * @return array
     */
    public static function getAll(){


        try{
            $db = static::getDB();
            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}