<?php
namespace App\Models;

use Core\Model;
use function json_encode;
use const JSON_UNESCAPED_UNICODE;
use PDOException;
use PDO;
use function strtolower;

class TypeDocument extends Model
{
    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Save a type document in the db
     * @return bool Return false if error exists, true otherwise
     */
    public function save(){
        $this->validate();

        if (empty($this->errors)) {
            $this->name = strtolower($this->name);
            $sql = 'INSERT INTO typesdocument (name) VALUES (:name)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stmt->execute();
        }
        return false;
    }

    public function update(){

    }

    /**
     * Validate field in type document name and record error in case of wrong entry
     */
    public function validate(){

        if ($this->name === '') {
            $this->errors[] = 'Nom de type de document requit !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type de document requière au moins une lettre !';
        }
    }

    public function delete(){

    }

    /**
     * Get list of name of TypesDocument as json object
     * @return false|string
     */
    public static function getListAsJson(){
        $sql = 'SELECT name FROM typesdocument';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get TypeDocument list as Json object
     * @param $subStringName The subtring of the name of document type entered in the search field
     * @return $jsonList List of DocumentType as json list
     */
    public static function getListSubAsJson($subStringName){
        $subStringName = strtolower($subStringName);
        $sql = 'SELECT * FROM typesdocument WHERE name LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $subStringName, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }
}