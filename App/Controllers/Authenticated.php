<?php
/**
 * File for Authenticated class
 * @package App\Controllers
 * @filesource
 */

namespace App\Controllers;

/**
 * Class Authenticated : Allow to require login before accessing controllers inherited from this class
 * @package App\Controllers
 */
abstract class Authenticated extends \Core\Controller
{
    /**
     * Inherited function from base Controller.
     * Used for requiring login before page load.
     *
     * @return void
     */
    protected function before(){
        $this->requireLogin();
    }
}