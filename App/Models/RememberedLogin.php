<?php


namespace App\Models;

use App\Token;
use function get_called_class;
use PDO;
use function strtotime;

/**
 * RememberedLogin Model
 * @package App\Models
 */
class RememberedLogin extends \Core\Model
{
    /**
     * Find remembered login by the token
     * @param string $token The remembered login token, extract from $cookie remember_me value
     * @return mixed Rememberd token if found, otherwise false
     */
    public static function findByToken($token){
        $token = new Token($token);
        $token_hash = $token->getHash();

        $sql = 'SELECT * FROM remembered_logins
                WHERE token_hash = :token_hash';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token_hash', $token_hash, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get the user model associated with this remembered login
     * @return User The user model
     */
    public function getUser(){
        return User::findByID($this->user_id);
    }

    /**
     * See if rememberd login has expired, false otherwise
     * @return boolean True if the token has expired, false otherwise
     */
    public function hasExpired(){
        return strtotime($this->expires_at) < time();
    }

    /**
     * Delete this model
     * @return void
     */
    public function delete(){
        $sql = 'DELETE FROM remembered_logins WHERE token_hash=:token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);

        $stmt->execute();
    }
}