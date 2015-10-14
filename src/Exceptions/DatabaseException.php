<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/29/15
 * Time: 12:04 PM
 *
 *
 * Custom database exception to return specific messages
 * for certain failures.
 */


namespace Verem\Persistence\Exceptions;

use PDOException;

class DatabaseException extends PDOException
{
    protected $code;
    protected $message;
    public function __construct(PDOException $e)
    {
        if (strstr($e->getMessage(), 'SQLSTATE[')) {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);

            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $this->message = $matches[3];
        }
    }

    /**
     * @return mixed
     *
     * return an error message
     */
     public function getErrorMessage()
     {
         return $this->message;
     }

     /**
     * @return mixed
     *
     * return a code representing an error
     */
     public function getErrorCode()
     {
         return $this->code;
     }
}
