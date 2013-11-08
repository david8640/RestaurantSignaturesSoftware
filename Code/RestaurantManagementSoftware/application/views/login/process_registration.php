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
        echo Form::open($submitAction);
        echo Form::hidden('id', $user->getId()) . "<br/>";
        echo Form::label('username', 'Username: ');
        echo Form::input('username') . "<br/>";
        echo Form::label('name', 'Name: ');
        echo Form::input('name') . "<br/>";
        echo Form::label('email', 'Email Address: ');
        echo Form::input('email') . "<br/>";
        echo Form::label('password', 'Password: ');
        echo Form::password('password') . "<br/>";
        echo Form::hidden('salt',$user->getSalt());
        echo Form::submit(NULL, 'Register');
        echo Form::close();
        ?>  
    </body>
</html>

