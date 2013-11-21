<?php
/*
 *  <copyright file="Register.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>Register Page.</summary>
 */
if (!isset($user)) {
    $random_Salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $user = new Model_User(-1, '', '', '', '',$random_Salt, '', 0);
}

if (!isset($submitAction)) {
    $submitAction = 'login/process_registration';
}
?>
<h1>Register a new user</h1>
<div class="form_content">
    <?php
    //Login Form
    echo Form::open($submitAction);
    echo Form::hidden('id', $user->getId()) . "<br/>";
    echo Form::label('username', 'Username: ');
    echo Form::input('username', $user->getUsername()) . "<br/>";
    echo Form::label('name', 'Name: ');
    echo Form::input('name', $user->getName()) . "<br/>";
    echo Form::label('email', 'Email Address: ');
    echo Form::input('email', $user->getEmail()) . "<br/>";
    echo Form::label('password', 'Password: ');
    echo Form::password('password') . "<br/>";
    echo Form::hidden('salt',$user->getSalt());
    echo Form::hidden('sessionID', Constants::BlankHash);
    echo Form::hidden('sessionExpiryTime',0);
    echo Form::submit(NULL, 'Register');
    echo Form::close();
?>
</div>