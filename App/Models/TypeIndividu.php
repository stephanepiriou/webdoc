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

    public function getList(){
        $sql = 'SELECT name FROM typesindividu';
    }

}