<?php
namespace App\Models;

use \Core\Model;
use function json_encode;
use PDO;
use function utf8_encode;
use function var_dump;

class TypeIndividu extends Model
{
    public $typeindividuid;

    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Save the TypeIndividu model with the current property values
     *
     * @return boolean  True if the user was saved, false otherwise
     */
    public function save(){
        $this->validate();

        if (empty($this->errors)) {

            $this->name = strtolower($this->name);
            $sql = 'INSERT INTO typesIndividu (name) VALUES (:name)';
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
     * validate the fields of form create and update and fill error[] viariable for user insight
     */
    public function validate(){

        if ($this->name === '') {
            $this->errors[] = 'Nom de type d&apos;individu requit !';
        }

        if (preg_match('/.*[a-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type d&apos;individu requière au moins une lettre !';
        }
    }

    public function delete(){

    }

    /**
     * Return a json list of all name of type of individu
     * @return json object
     */
    public static function getListAsJson(){
        $sql = 'SELECT name FROM typesindividu';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get the id of the index of
     * @param $name $name The name of the TypeIndividu
     *
     */
    public static function getIndexFromName($name){
        $sql = 'SELECT * FROM typesindividu WHERE name=:name ';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $name]);
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($array as $key =>$value){
            $index = $value;
            break;
        }
        return $index;
    }

    /**
     * Get TypeDocument list as Json object
     * @param $subStringName The subtring of the name of document type entered in the search field
     * @return $jsonList List of DocumentType as json list
     */
    public static function getListSubAsJson($subStringName){
        $subStringName = strtolower($subStringName);
        $sql = 'SELECT * FROM typesindividu WHERE name LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $subStringName, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }
}