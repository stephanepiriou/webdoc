<?php
namespace App\Models;

use Core\Model;
use PDOException;
use PDO;

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
    public function __construct($data = [])
    {
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

        if (preg_match('/.*[a-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type de document requière au moins une lettre !';
        }
    }

    public function delete(){

    }

    /**
     * Fetch all user
     */
    public function list(){

    }
}