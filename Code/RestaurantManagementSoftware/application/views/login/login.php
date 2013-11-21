<?php
/*
 *  <copyright file="login.php" company="RestaurantManagementSoftware">
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
$ipaddress = '127.0.0.1';
     if (getenv('HTTP_CLIENT_IP'))
         $ipaddress = getenv('HTTP_CLIENT_IP');
     else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
     else if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
     else
         $ipaddress = 'UNKNOWN';

//Login Form
echo Form::open($submitAction);
echo Form::label('username', 'Username :');
echo Form::input('username') . "<br/>";
echo Form::label('password', 'Password :');
echo Form::password('password') . "<br/>";
echo Form::hidden('ipaddress', $ipaddress);
echo Form::submit(NULL, 'Login');
echo Form::close();
echo HTML::anchor('login/register', 'Register') . "<br/>";

