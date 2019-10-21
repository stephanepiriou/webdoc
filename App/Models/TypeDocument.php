<?php
/**
 * File for TypeDocument class
 * @package App\Models
 * @filesource
 */

namespace App\Models;

use Core\Model;
use function json_encode;
use const JSON_UNESCAPED_UNICODE;
use PDOException;
use PDO;
use function strtolower;

/**
 * Class TypeDocument
 * Represent an element of the database table TypesDocument
 * and allow to retrieve and create data from that entity
 * @package App\Models
 */
class TypeDocument extends Model
{
    /**
     * Errors from create and update operation (see validate() method)
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     * @param array $data Initial property values (optional)
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
	    $this->name = strtolower($this->name);
        if($this->checkTypeDocumentExist($this->name)){
            $this->errors[] = 'Un type de document avec ce nom existe déjà.';
        }else {
		    $this->validate();
	    }

        if (empty($this->errors)) {
            $sql = 'INSERT 
                    INTO typesdocument (name) 
                    VALUES (:name)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stmt->execute();
        }
        return false;
    }

	/**
	 * Check if typedocument exist in the DB
	 * @param string $name The document name
	 * @return bool True if document exist false otherwise
	 */
	private function checkTypeDocumentExist($name){
		$sql = 'SELECT count(*)
                FROM typesdocument
                WHERE name=:name';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();

		return ($count > 0 ? true : false);
	}

	/**
	 * Check if there is already a typedocument in the database
	 * @return boolean false if not user, true otherwise
	 **/
	public static function isThereFirstTypeDocument(){
		$sql = 'SELECT count(*)
                FROM typesdocument';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0 ? true : false);
	}

	/**
     * Validate field in type document name and record error in case of wrong entry
     * @return void
     */
    public function validate(){

        if ($this->name === '') {
            $this->errors[] = 'Nom de type de document requit !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type de document requière au moins une lettre !';
        }

        if (preg_match('/^[0-9A-Za-zéèëêïîôöûüùäâà\-_ ]*$/', $this->name) === 0) {
            $this->errors[] = 'Seul les caractères "/^[0-9A-Za-zéèëêïîôöûüäâ\-_ ]*$/" sont autorisés !';
        }
    }

        /**
	     * See if a typesdocument record already exists with the specified name
	     * @param string $name name to search for
	     * @return boolean True if a record already exists with the specified email, false otherwise
	     */
        public static function nameExists($name){
    	    return static::findByName($name) !== false;
        }

		/**
		 * Find a typedocument model by name
		 * @param string $name to search for
		 * @return mixed User object if found, false otherwise
		 */
		public static function findByName($name){
			$sql = 'SELECT * 
	                FROM typesdocument 
	                WHERE name =:name';
			$db = static::getDB();
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
			$stmt->execute();
			return $stmt->fetch();
		}

    /**
     * Get list of name of TypesDocument as json object
     * @return false|string
     */
    public static function getListAsJson(){
        $sql = 'SELECT name 
                FROM typesdocument';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get the id of the index of
     * @param string $name The name of the TypeIndividu
     */
    public static function getIndexFromName($name){
        $sql = 'SELECT * 
                FROM typesdocument 
                WHERE name=:name ';
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
     * Get name of document type from its index
     * @param $id int Ined of searched TypeIndividu
     * @return string TypeIndividu name from index
     */
    public static function getNameFromIndex($id){
        $sql = 'SELECT * 
                FROM typesdocument 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $typesIndividu = $stmt->fetch();
        return $typesIndividu->name;
    }

    /**
     * Get TypeDocument list as Json object
     * @param string $subStringName The subtring of the name of document type entered in the search field
     * @return string $jsonList List of DocumentType as json list
     */
    public static function getListSubAsJson($subStringName){
        $subStringName = strtolower($subStringName);
        $sql = 'SELECT * 
                FROM typesdocument 
                WHERE name LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $subStringName, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get a TypeDocument object from its id in database
     * @param int $id The id of the looked for typesDocument
     * @return object TypeDocument object
     */
    public static function getById($id){

        $sql = 'SELECT * 
                FROM typesdocument 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $typesIndividu = $stmt->fetch();
        return $typesIndividu;
    }

    /**
     * Update TypeDocument object in the database
     * @param int $id The id of the object to update
     * @return boolean True if success, false otherwise.
     */
    public function update(){
        $this->validate();

        if(empty($this->errors)){
            $this->name = strtolower($this->name);
            $sql = 'UPDATE typesdocument 
                    SET name=:name 
                    WHERE id=:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    /**
     * Delete TypeDocument object in the database if not used
     * @param int $id The id of the object to delete
     * @return mixed
     */
    public static function delete($id){
        $sql = 'DELETE 
                FROM typesdocument 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}