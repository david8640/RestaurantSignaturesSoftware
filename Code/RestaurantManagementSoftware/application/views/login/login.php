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

$username = Session::instance()->get_once('username');
if (!isset($username)) {
    $username = '';
}

if (isset($loginFeedbackMessage)) {
    $messages = $loginFeedbackMessage;
} elseif (Session::instance()->get('loginFeedbackMessage') != '') {
    $messages = Session::instance()->get_once('loginFeedbackMessage');
} else {
    $messages = array();
}

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
?>
<div class="login">
    <h1>Login</h1>
    <?php
    // Login feedback message
    ?><div class="error_message"><?php
    foreach ($messages as $message):
        echo $message."<br/>";
    endforeach;
    ?></div><?php
    //Login Form
    echo Form::open($submitAction);
    echo Form::label('username', 'Username :');
    echo Form::input('username', $username, array ('placeholder'=> 'username')) . "<br/>";
    echo Form::label('password', 'Password :');
    echo Form::password('password', '', array ('placeholder'=> 'password')) . "<br/>";
    echo Form::hidden('ipaddress', $ipaddress);
    ?>
    <div class="clear"></div>    
    <?php
    echo Form::submit(NULL, 'Login');
    echo HTML::anchor('login/register', 'Register') . "<br/>";
    echo Form::close();
    ?>
</div>