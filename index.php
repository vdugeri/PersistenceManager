<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 12:01 PM
 */

require_once('vendor/autoload.php');

use Verem\User;


try{

	$result = User::destroy(8);
	die((bool)$result);
}catch(\Verem\Persistence\Exceptions\DatabaseException $e) {
	echo $e->getErrorMessage();
}












