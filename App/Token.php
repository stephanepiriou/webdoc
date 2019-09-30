<?php
/**
 * File for Token class
 * @package App
 * @filesource
 */
namespace App;

use \App\Config;

/**
 * Class Token
 * Save and get the authentication cookie under hashed form, for security purpose.
 * @package App
 */
class Token
{

    /**
     * The token value
     * @var array
     */
    protected $token;

    /**
     * Token constructor. Create a new random token
     * @param $token_value the hashed valus which store the cookie value
     * @return void
     */
    public function __construct($token_value = null){
        if ($token_value){
            $this->token = $token_value;
        } else{
            $this->token = bin2hex(random_bytes(16));
        }

    }

    /**
     * Get value of the token
     * @return string The value
     */
    public function getValue(){
        return $this->token;
    }

    /**
     * Get hash of the token
     * @return string The hashed value
     */
    public function getHash(){
        return hash_hmac('sha256', $this->token, Config::SECRET_KEY);
    }

}