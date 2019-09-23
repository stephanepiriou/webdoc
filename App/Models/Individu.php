<?php
/**
 * File for Individu class
 * @package App\Models
 */
namespace App\Models;

use Core\Model;
use App\Models\TypeIndividu;
use PDOException;
use PDO;

/**
 * Class Individu
 * Represent and Individu object from the table Individus in the database
 * and allow retrieval and record of data in the table
 * @package App\Models
 */
class Individu extends Model
{
    /**
     * Error messages from create and update operation (see validate() method)
     * @var array
     */
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
     * Save the Individu model with the current property values
     *
     * @return boolean  True if the individu was saved, false otherwise
     */
    public function save(){
    	if(TypeIndividu::isThereFirstTypeIndividu()){
    	    if($this->checkIndividuExist($this->matricule) ){
    		    $this->errors[] = 'Un individu avec ce matricule existe déjà.';
	        }else {
		        $this->validate();
	        }
	    }else{
    		$this->errors[]= 'Il n\'y a pas de type d\'individu auquel lié cet individu. Veuillez créer un type d\'individu avant de procéder à la création d\'un individu';
	    }

        if (empty($this->errors)) {
            $this->firstname = strtolower($this->firstname);
            $this->lastname = strtolower($this->lastname);
            $this->adress = strtolower($this->adress);
            $this->city = strtolower($this->city);
            $sql = 'INSERT 
                    INTO individus (matricule, firstname, lastname, adress, city, postalcode, typeindividuid) 
                    VALUES (:matricule, :firstname, :lastname, :adress, :city, :postalcode, :typeindividuid)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':matricule', $this->matricule, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue(':adress', $this->adress, PDO::PARAM_STR);
            $stmt->bindValue(':city', $this->city, PDO::PARAM_STR);
            $stmt->bindValue(':postalcode', $this->postalcode, PDO::PARAM_STR);
            $stmt->bindValue(':typeindividuid', $this->typeindividuid, PDO::PARAM_INT);
            return $stmt->execute();
        }
        return false;
    }


	/**
	 * Check if individu exist in the DB
	 * @param string $matricule The matricule of the individu
	 * @return boolean True if document exist false otherwise
	 */
	private function checkIndividuExist($matricule){
		$sql = 'SELECT count(*)
                FROM individus
                WHERE matricule=:matricule';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':matricule', $matricule, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0 ? true : false);
	}

    /**
     * Validate field and fill errors array in case of error
     * @return void
     */
    public function validate(){

        if ($this->matricule === '') {
            $this->errors[] = 'Matricule requit !';
        }

        if (preg_match('/.*[A-Za-z0-1]+.*/i', $this->matricule) === 0) {
            $this->errors[] = 'Matricule n&apos;accepte que des chiffres et des lettres !';
        }

        if ($this->firstname === '') {
            $this->errors[] = 'Prénom requit !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->firstname) === 0) {
            $this->errors[] = 'Prénom n&apos;accepte que des lettres !';
        }

        if ($this->lastname === '') {
            $this->errors[] = 'Nom requit !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->lastname) === 0) {
            $this->errors[] = 'Nom de famille n&apos;accepte que des lettres !';
        }

        if ($this->adress === '') {
            $this->errors[] = 'Addresse requise !';
        }

        if (preg_match('/.*[A-Za-z0-9]+.*/i', $this->adress) === 0) {
            $this->errors[] = 'Addresse n&apos;accepte que des chiffres et des lettres !';
        }

        if ($this->city === '') {
            $this->errors[] = 'Ville requise !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->city) === 0) {
            $this->errors[] = 'Ville n&apos;accepte que des lettres !';
        }

        if ($this->postalcode === '') {
            $this->errors[] = 'Code postal requit !';
        }

        if(strlen($this->postalcode) !== 4){
            $this->errors[] = 'Le code postal ne peut admettre que 4 chiffres !';
        }

        if (preg_match('/.*[0-9]+.*/i', $this->postalcode) === 0) {
            $this->errors[] = 'Le code postal n&apos;accepte que des chiffres !';
        }

    }


	/**
	 * See if a individu record already exists with the specified matricule
	 * @param string $matricule matricule to search for
	 * @return boolean True if a record already exists with the specified email, false otherwise
	 */
	public static function matriculeExists($matricule){
		return static::findByMatricule($matricule) !== false;
	}

	/**
	 * Find a user model by matricule
	 * @param string $matricule to search for
	 * @return mixed User object if found, false otherwise
	 */
	public static function findByMatricule($matricule){
		$sql = 'SELECT * 
                FROM individus 
                WHERE matricule = :matricule';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':matricule', $matricule, PDO::PARAM_STR);
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
		$stmt->execute();
		return $stmt->fetch();
	}


    /**
     * Search user with the current matricule
     * @param string matricule
     */
    public static function listByMatricule($matricule){
        $sql = 'SELECT * 
                FROM individus 
                WHERE matricule LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $matricule, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Search user with the current name
     * @param string $name
     */
    public static function listByName($name){
        $subStringName = strtolower($name);
        $sql = 'SELECT * 
                FROM individus 
                WHERE name LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $name, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get Individu object from db with the current id passed in parametre
     * @param int $id of the individu in the db
     * @return object an individu object created from database field or false
     */
    public static function getById($id){
        $sql = 'SELECT * 
                FROM individus 
                WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $individu = $stmt->fetch();
        return $individu;
    }

    /**
     * Update Individu object in the database
     * @param int $id The id of the object to update
     * @return boolean True if success, false otherwise.
     */
    public function update(){
        $this->validate();

        if(empty($this->errors)){
            $this->firstname = strtolower($this->firstname);
            $this->lastname = strtolower($this->lastname);
            $this->adress = strtolower($this->adress);
            $this->city = strtolower($this->city);

            $sql = 'UPDATE individus 
                    SET matricule=:matricule, firstname=:firstname, lastname=:lastname, adress=:adress, city=:city, postalcode=:postalcode, typeindividuid=:typeindividuid 
                    WHERE id=:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
            $stmt->bindParam(':adress', $this->adress, PDO::PARAM_STR);
            $stmt->bindParam(':city', $this->city, PDO::PARAM_STR);
            $stmt->bindParam(':postalcode', $this->postalcode, PDO::PARAM_STR);
            $stmt->bindValue(':typeindividuid', $this->typeindividuid, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    /**
     * Delete Individu object in the database if not used
     * @param int $id The id of the object to delete
     * @return boolean mixed
     */
    public static function delete($id){
        $sql = 'DELETE 
                FROM individus 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}