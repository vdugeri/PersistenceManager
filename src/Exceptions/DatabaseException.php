<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/29/15
 * Time: 12:04 PM
 */

namespace Verem\Persistence\Exceptions;

use PDOException;

class DatabaseException extends PDOException {


	private $message;
	private $code;
	public function __construct(PDOException $e)
	{
		if(strstr($e->getMessage(), 'SQLSTATE[')) {
			preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
			$this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
			$this->message = $matches[3];
		}
	}

	public function getErrorMessage()
	{
		return $this->message;
	}

	public function getErrorCode()
	{
		return $this->code;
	}
}