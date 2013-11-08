<?php

/* 
 *  <copyright file="index.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-30</date>
 *  <summary>The main container of the application.</summary>
 */

?>
<html>
<head>
    <title></title>
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
                echo $message."<br/>";
            endforeach;
        
            echo $body; 
        ?>
    </body>
</html>