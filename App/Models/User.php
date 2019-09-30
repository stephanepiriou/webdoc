<?php
/**
 * File for User class
 * @package App\Models
 * @filesource
 */

namespace App\Models;

use App\Token;
use function get_called_class;
use PDO;
use function strtolower;

/**
 * User model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Error messages from create and update operation (see validate() method)
     * @var array $errors Array
     * */
    public $errors = [];

    /**
     * Token used for the connection cookie
     * @var string $remember_token
     */
    public $remember_token;

    /**
     * The expirity date of the connection cookie, calculated to be 30 day in the futur
     * @var datetime $expiry_timestamp
     */
    public $expiry_timestamp;
    /**
     * Class constructor
     * @param array $data  Initial property values (optional)
     * @return void
     */
    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Save the user model with the current property values
     * @return boolean True if the user was saved, false otherwise
     */
    public function save(){
        $this->validate();

        if (empty($this->errors)) {
            $this->name = strtolower($this->name);
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = 'INSERT 
                    INTO users (name, email, password_hash) 
                    VALUES (:name, :email, :password_hash)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    /**
     * Validate current property values, adding valiation error messages to the errors array property
     * @return void
     */
    public function validate(){
        // Name
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }

        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }
        if (static::emailExists($this->email)) {
            $this->errors[] = 'email already taken';
        }

        // Password
        if (strlen($this->password) < 6) {
            $this->errors[] = 'Please enter at least 6 characters for the password';
        }

        if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one letter';
        }

        if (preg_match('/.*\d+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    /**
     * Validation for update opération. (Removed email validation))
     * @return void
     */
    public function validateForUpdate(){
        // Name
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }

        // Password
        if (strlen($this->password) < 6) {
            $this->errors[] = 'Please enter at least 6 characters for the password';
        }

        if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one letter';
        }

        if (preg_match('/.*\d+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    /**
     * See if a user record already exists with the specified email
     * @param string $email email address to search for
     * @return boolean True if a record already exists with the specified email, false otherwise
     */
    public static function emailExists($email){
        return static::findByEmail($email) !== false;
    }

    /**
     * Find a user model by email address
     * @param string $email email address to search for
     * @return mixed User object if found, false otherwise
     */
    public static function findByEmail($email){
        $sql = 'SELECT * 
                FROM users 
                WHERE email = :email';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Find a user model by email address
     * @param string $id email address to search for
     * @return mixed User object if found, false otherwise
     */
    public static function findByID($id){
        $sql = 'SELECT * 
                FROM users 
                WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Authenticate a user by email and password.
     * @param string $email email address
     * @param string $password password
     * @return mixed  The user object or false if authentication fails
     */
    public static function authenticate($email, $password){
        $user = static::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {
                return $user;
            }
        }
        return false;
    }

    /**
     * Check if a user already exist in the database
     * @return boolean false if not user, true otherwise
     **/
    public static function isThereFirstUser(){
        $sql = 'SELECT count(*)
                FROM users';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return ($count > 0 ? true : false);
    }

    /**
     * Check if there is only 1 user in the database
     * @return boolean false if more than 1 user, true otherwise
     **/
    private static function isThereOnlyOneUser(){
        $sql = 'SELECT count(*)
                FROM users';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return ($count == 1 ? true : false);
    }


    /**
     * Remember the login by inserting a unique token into the remember_logins table
     * for this user record
     * @return boolean True ifthe login was remembered successfully false otherwise
     */
    public function rememberLogin(){
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->expiry_timestamp = time()+60 * 60 * 24*30;
        $this->remember_token = $token->getValue();
        $sql = 'INSERT 
                INTO remembered_logins (token_hash, user_id, expires_at) 
                VALUE (:token_hash, :user_id, :expires_at)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s',$this->expiry_timestamp), PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Get TypeDocument list as Json object
     * @param string $subEmail The subtring of the name of Individu entered in the search field
     * @return string $jsonList List of Individus as json list
     */
    public static function getEmailListSubAsJson($subEmail){
        $subStringEmail = strtolower($subEmail);
        $sql = 'SELECT * 
                FROM users 
                WHERE email LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $subStringEmail, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Update TypeDocument object in the database
     * @param $id The id of the object to update
     * @return boolean True if success, false otherwise.
     */
    public function update(){
        $this->validateForUpdate();

        if(empty($this->errors)){
            $this->name = strtolower($this->name);
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = 'UPDATE users 
                    SET name=:name, password_hash=:password_hash 
                    WHERE id=:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    /**
     * Delete TypeDocument object in the database if not used
     * @param $id The id of the object to delete
     * @return mixed
     */
    public static function delete($id){
        if(!static::isThereOnlyOneUser()){
            $sql = 'DELETE 
                    FROM users 
                    WHERE id=:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }else {
            return false;
        }
    }
}
