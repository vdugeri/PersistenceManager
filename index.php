<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 12:01 PM
 */

require_once('vendor/autoload.php');

use Verem\Persistence\User;

// //save a user
// $user = new User();
// $user->username = "Terryd";
// $user->password = "password";
// $user->email = "ter@terryd.dom";
// $user->save();

// //find a user
// var_export($user::find(1));

// //update a user;
// $user = User::find(2);
// $user->email = 'danverem@mail.com';
// $user->save();

//delete a user
User::destroy(20);

//find all users
// print_r(User::all());













