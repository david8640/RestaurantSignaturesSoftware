<?php
/*
 *  <copyright file="Generic.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The template page.</summary>
 */
        if (!isset($user)) {
            $random_Salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $user = new Model_User(-1, '', '', '', '',$random_Salt);
            $pageName = 'Add User';
        } else {
            $pageName = 'Edit User';
        }

        if (!isset($submitAction)) {
            $submitAction = 'login/process_registration';
        }
?>


<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo "Register" ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
    </head>
    <body>
        <?php
        if (isset($feedbackMessage)) {
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




        <?php
        //Login Form
        echo "Registration:";
        echo form::open($submitAction);
        echo form::hidden('id', $user->getId()) . "<br/>";
        echo form::label('username', 'Username: ');
        echo form::input('username') . "<br/>";
        echo form::label('name', 'Name: ');
        echo form::input('name') . "<br/>";
        echo form::label('email', 'Email Address: ');
        echo form::input('email') . "<br/>";
        echo form::label('password', 'Password: ');
        echo form::password('password') . "<br/>";
        echo form::hidden('salt',$user->getSalt());
        echo form::submit(NULL, 'Register');
        echo form::close();
        ?>  
    </body>
</html>

