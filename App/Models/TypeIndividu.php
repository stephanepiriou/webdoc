<?php
namespace App\Models;

use \Core\Model;
use PDO;

class TypeIndividu extends Model
{

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

    public function liste(){

    }
}