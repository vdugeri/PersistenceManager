<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 12:01 PM
 */

require_once('vendor/autoload.php');

use Verem\Persistence\User;

//save a user
$user = new User();
$user->username = "Terry";
$user->password = "pass";
$user->email = "ter@terry.dom";
$user->save();

//find a user
var_export($user::find(1));

//update a user;
$user = User::find(2);
$user->email = 'danvery@mail.com';
$user->save();

//delete a user
User::destroy(10);

//find all users
print_r(json_encode(User::all()));













