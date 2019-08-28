<?php
namespace App;

/**
 * Configuration settings of the application
 * @package App
 */
class Config
{
    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'webdoc';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD= 'azertyuiop';

    /**
     * Show or hide error message on screen
     * @var boolean
     */
    const SHOW_ERROR = true;

    /**
     * Secret key for hashing token
     * @var string
     */
    const SECRET_KEY = 'KaYHJi790Au70xMeJWjKt5UG9Ns5Jt9S';

    /**
     * Absolute Uplaod folder
     * @var string
     */
    const ABSOLUTE_UPLOAD_FOLDER = '/Users/stephane/PhpstormProjects/webdoc/public/uploads/';

    /**
     * Relative Upload folder
     * @var string
     */
    const RELATIVE_UPLOAD_FOLDER = '/uploads/';

    /**
     * Server URL
     * @var string
     */
    const SERVER_URL = 'http://webdoc.local';
}