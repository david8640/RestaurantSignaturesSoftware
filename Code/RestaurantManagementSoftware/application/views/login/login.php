<?php
/*
 *  <copyright file="Generic.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The template page.</summary>
 */
if (!isset($submitAction)) {
    $submitAction = 'login/process_login';
}
?>
<h1>Login</h1>
<?php
//Login Form
echo Form::open($submitAction);
echo Form::label('username', 'Username :');
echo Form::input('username') . "<br/>";
echo Form::label('password', 'Password :');
echo Form::password('password') . "<br/>";
echo Form::submit(NULL, 'Login');
echo Form::close();

