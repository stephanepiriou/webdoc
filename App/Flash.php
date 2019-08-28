<?php


namespace App;

/**
 * Class Flash
 *
 * Display message intended to inform the user regarding the login
 * @package App
 */
class Flash
{
    /**
     * Success message type
     * @var string
     */
    const SUCCESS = 'success';

    /**
     * Information message type
     * @var string
     */
    const INFO = 'info';

    /**
     * Warning message type
     * @var string
     */
    const WARNING = 'warning';

    /**
     * Add a message
     *
     * @param $message The message content
     *
     * @return void
     */
    public static function addMessage($message, $type = 'success'){
        if (! isset($_SESSION['flash_notification'])){
            $_SESSION['flash_notification'] = [];
        }

        $_SESSION['flash_notification'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    public static function getMessage(){
        if(isset($_SESSION['flash_notification'])){
            $messages = $_SESSION['flash_notification'];
            unset($_SESSION['flash_notification']);
            return $messages;
        }
    }
}