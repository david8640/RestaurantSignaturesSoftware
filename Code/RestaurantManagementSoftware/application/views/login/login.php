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


<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo "Title" ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
    </head>
    <body>
        <?php
        if (isset($feedbackMessage)) {
            echo 'test';
            $messages = $feedbackMessage;
        } elseif (Session::instance()->get('feedbackMessage') != '') {
            $messages = Session::instance()->get_once('feedbackMessage');
        } else {
            $messages = array();
        }

        foreach ($messages as $message):
            echo $message . "<br/>";
        endforeach;
        ?>
        

        <?php //Login Form
        echo "Login";
        echo form::open($submitAction);
        echo form::label('username', 'Username :');
        echo form::input('username') . "<br/>";
        echo form::label('password', 'Password :');
        echo form::input('password') . "<br/>";
        echo form::submit(NULL, 'Login');
        echo form::close();
        ?>  
    </body>
</html>

