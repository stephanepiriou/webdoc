<?php
/**
 * File for Error class
 * @package Core
 * @filesource
 */

namespace Core;


use Exception;
use App\Config;

/**
 * Class Error : Handles errors and if errors have to be shown to the tester or logged in .log file (in log folder)
 * @package Core
 */
class Error
{
    /**
     * Error Handler of Error occuring in the app
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     * @return void
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line){
        if (error_reporting() !== 0){
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler
     * @param Exception $exception The exception
     * @return void
     */
    public static function exceptionHandler($exception){
        $code = $exception->getCode();
        if ($code != 404){
            $code = 500;
        }
        http_response_code($code);

        //Check if Configuration allow to show errors.
        if (Config::SHOW_ERROR){
            echo '<h1>Fatal Error</h1>';
            echo "<p>Uncaught Exception: '". get_class($exception) ."'</p>";
            echo "<p>Message: '". $exception->getMessage() ."'</p>";
            echo "<p>Stack: <pre>'". $exception->getTraceAsString()."'</pre></p>";
            echo "<p>Thrown in '". $exception->getFile() ."' on line ". $exception->getLine(). "</p>";
        }else {
            $log = dirname(__DIR__).'/logs/'.date('Y-m-d').'.log';
            ini_set('error_log', $log);
            $message = "Uncaught Exception: '". get_class($exception) ."' with \n";
            $message .= "Message: '". $exception->getMessage() ."'. \n";
            $message .= "\nStack: '". $exception->getTraceAsString()."'. \n";
            $message .= "\nThrown in '". $exception->getFile() ."' on line ". $exception->getLine(). ".\n\n";
            error_log($message);
            View::render("$code.php");
        }
    }


}