<?php


namespace Core;


use Exception;
use App\Config;

class Error
{
    /**
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
            /*if ($code == 404){
                echo "<h1>Page not found.</h1>";
            }else{
                echo "<h1>An error occured.</h1>";
            }
            */
            View::render("$code.php");
        }
    }


}