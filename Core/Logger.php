<?php
/**
 * Code inspired from https://stackoverflow.com/questions/15281888/custom-php-logging-class-keeps-double-writing-error-messages     
 */

namespace Core;

use App\Config;
use FilesystemIterator;
/**
 * Class Logger
 * Custom logger class which handle error outside of error handling context
 * @package App
 */
class Logger {
    /**
     * Log regarding login and logout of users
     * @var int
     */
    const LOGIN = 0;

    /**
     * Log regarding user input
     * @var int
     */
    const USER_INPUT = 1;

    /**
     * Log regarding Controller/Method path
     * @var int
     */
    const PATH = 2;

    /**
     * Log regarding database request
     * @var int
     */
    const DATABASE = 3;

    /**
     * Download Bug
     * @var int
     */
    const DOWNLOAD = 4;

    /**
     * Upload Bug
     * @var int
     */
    const UPLOAD = 5;

    /**
     * Log in debug mode
     * @var int
     */
    const DEBUG = 6;

    /**
     * Logging system is on
     * @var bool
     */
    const LOG_ENABLED = true;

    /**
     * Log fil path
     * @var string|null
     */
    private $logpath = null;

    /**
     * Type of log, defined by LOGIN | USER_INPUT | PATH | DATABASE | DEBUG
     * @var int
     */
    private $logtype;

    /**
     * Check if the file is writable
     * @var bool
     */
    private $filestatus = false;

    /**
     * Is the log system enabled
     * @var bool
     */
    private $logenabled;


    /**
     * Logger constructor.
     * @param int $logtype
     */
    public function __construct($logtype = self::DEBUG, $logenabled) {
        $this->logenabled=$logenabled;
        if ($this->logenabled == self::LOG_ENABLED) {
            $this->logpath = Config::ABSOLUTE_LOG_FOLDER . date('Y-m-d') . '.logger.log';
            $this->logtype = $logtype;
            // Check for and create the directory for the logs if not created already
            if (!file_exists(Config::ABSOLUTE_LOG_FOLDER)) {
                mkdir(Config::ABSOLUTE_LOG_FOLDER, 0777, true);
            }

            if (file_exists($this->logpath) && !is_writable($this->logpath)) {
                $this->filestatus = false;
            } else {
                $this->filestatus = true;
            }
        }
        $this->deleteOldLogFile();
    }

    /**
     * Write the log string in the log file
     * @param $line string
     * @param string $args
     * @return bool
     */
    public function writeLog($line) {
        if ($this->logenabled == self::LOG_ENABLED) {
            if ($this->filestatus) {
                $line = $this->buildString($line);
                $line .= "\r\n";

                if (($file = fopen($this->logpath, 'a'))) {
                    if (fwrite($file, $line)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Build the actual string entered in the log file
     * @param $line
     * @return string
     */
    private function buildString($line) {
        $time = date('Y-m-d G:i:s');
        switch ($this->logtype) {
            case self::LOGIN:
                return "$time - LOGIN --> $line";
            case self::USER_INPUT:
                return "$time - USER_INPUT --> $line";
            case self::PATH:
                return "$time - PATH --> $line";
            case self::DATABASE:
                return "$time - DATABASE --> $line";
            case self::DOWNLOAD:
                return "$time - DOWNLOAD --> $line";
            case self::UPLOAD:
                return "$time - UPLOAD --> $line";
            case self::DEBUG:
                return "$time - DEBUG --> $line";
            default:
                return "$time - LOG --> $line";
        }
    }

    /**
     * Delete log files older than specified number of day in Config::LOG_FILES_TO_KEEP
     */
    private function deleteOldLogFile(){
        $files = new FilesystemIterator(Config::ABSOLUTE_LOG_FOLDER, FilesystemIterator::SKIP_DOTS | FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::UNIX_PATHS |  FilesystemIterator::CURRENT_AS_FILEINFO);
        $nbrfiles = iterator_count($files);
        $currenttime = time();
        $timetokeep = Config::LOG_FILES_TO_KEEP*24*3600;

        if ($nbrfiles > Config::LOG_FILES_TO_KEEP){
            foreach ($files as $key => $fileinfo){
                $filetimestamp = $fileinfo->getCTime();
                $fileage =  $currenttime - $filetimestamp;
                if ($fileage > $timetokeep){
                    unlink($key);
                }
            }

        }
    }
}