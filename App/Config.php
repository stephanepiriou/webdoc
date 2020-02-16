<?php
/**
 * File for Config class
 * @package App
 * @filesource
 */
namespace App;

/**
 * Configuration settings of the application
 * @package App
 *
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
    const DB_USER = 'stephane';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD= 'justafuckingpassword';

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
    const ABSOLUTE_UPLOAD_FOLDER = '/var/www/public/uploads/';

    /**
     * Relative Upload folder
     * @var string
     */
    const RELATIVE_UPLOAD_FOLDER = '/uploads/';

    /**
     * Server URL
     * @var string
     */
    const SERVER_URL = 'https://webdoc.ovh/';

    /**
     * Absolute path for backup folder
     * @var string
     */
    const ABSOLUTE_BACKUP_FOLDER = '/var/www/backup/';

    /**
     * absolute log folder path
     * @var string
     */
    const ABSOLUTE_LOG_FOLDER = "/var/www/logs/";

    /**
     * Logging system is on
     * @var bool
     */
    const LOG_ENABLED = true;

    /**
     * The number of log files to keep
     * @var int
     */
    const LOG_FILES_TO_KEEP = 30;

    /**
     * @var string Remote host for backup
     */
    const REMOTE_FTP_HOST = 'www.webdoc.ovh';

    /**
     * Remote ftp user for backup
     * @var string
     */
    const REMOTE_FTP_USER = 'ftpuser';

    /**
     * Remote ftp password for backup
     * @var string
     */
    const REMOTE_FTP_PASSWORD = 'justafuckingpassword';

    /**
     * Absolute Collect Folder
     * @var string
     */
    const ABSOLUTE_COLLECT_FOLDER = '/var/www/collect/';

    /**
     * Relative Collect Folder
     * @var string
     */
    const RELATIVE_COLLECT_FOLDER = '/collect/';
}