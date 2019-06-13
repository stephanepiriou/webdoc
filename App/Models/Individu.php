<?php
namespace App\Models;

use Core\Model;
use PDOException;
use PDO;
use function strlen;
use function var_dump;

class Individu extends Model
{
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
        $this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO individus (matricule, firstname, lastname, adress, city, postalcode, typeindividuid) VALUES (:matricule, :firstname, :lastname, :adress, :city, :postalcode, :typeindividuid)';
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

    public function update(){

    }

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

    public function delete(){

    }

    /**
     * Search user with the current matricule
     * @param string matricule
     */
    public function searchByMatricule($matricule){

    }

    /**
     * List all user with the lastname starting by the first 4 letters of the current lastname
     * @param string lastname
     */
    public function listByLastName($lastname){

    }
}