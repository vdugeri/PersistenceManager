<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 12:01 PM
 */

require_once('vendor/autoload.php');

use Verem\User;

$user = new User();
$user->username = "Ter";
$user->password = "pass";
$user->email = "ter@terry.dom";
$user->save();

User::destroy(37);












