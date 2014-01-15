<?php

/* 
 *  <copyright file="Generic.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The template page.</summary>
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php echo HTML::style('application/style/style.css'); ?>
    <?php echo HTML::script('application/scripts/jquery-1.10.2.min.js'); ?>
</head>
    <body>
        <?php
        if (Session::instance()->get('global_username') != '') {
            $global_username = Session::instance()->get_once('global_username');
        }
        
        if (!isset($locations)) {
            $locations = array();
        }
        
        if (!$hide_menu) { ?>
            <div class="menu">
                <ul>
                    <li><?php echo HTML::anchor('index/index', 'Home'); ?></li>
                    <li><?php echo HTML::anchor('supplier/findAll', 'Suppliers'); ?></li>
                    <li><?php echo HTML::anchor('productCategory/findAll', 'Product Categories'); ?></li>
                    <li><?php echo HTML::anchor('restaurant/findAll', 'Restaurants'); ?></li>
                    <li><?php echo HTML::anchor('restaurantUser/findAll', 'User Access'); ?></li>
                </ul>
                <div class="right">
                    <?php 
                    if (count($locations) > 0) { 
                        echo Form::hidden('id_user', $global_user_id, array('id' => 'id_user')); ?>
                        <span class="item">
                            <select id="locations">
                                <?php foreach ($locations as $l) { ?>
                                    <option value="<?php echo $l->getId(); ?>" <?php echo (($l->getId() == $global_selected_location) ? 'selected': ''); ?>>
                                        <?php echo $l->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </span>
                    <?php } ?>
                    <span class="item">
                        <?php
                         if (isset($global_username)) {
                            echo 'Welcome back ' . $global_username;
                        } ?>
                    </span>
                    <span class="item">
                        <?php echo HTML::anchor('login/logout', 'Logout'); ?>
                    </span>
                </div>
            </div><?php
        }

        if (isset($feedbackMessage)) {
            $messages = $feedbackMessage;
        } elseif (Session::instance()->get('feedbackMessage') != '') {
            $messages = Session::instance()->get_once('feedbackMessage');
        } else {
            $messages = array();
        }

        ?><div class="error_message" id="error_message"><?php
        foreach ($messages as $message):
            echo $message."<br/>";
        endforeach;
        ?></div>
        <div class="content"><?php
            echo $content;
        ?></div>
        
        <script>
            $('#locations').change(function() {
                var userId = $('#id_user').val();
                var locationId = $('#locations :selected').val();
               $.post('<?php echo URL::site('Login/selectLocation'); ?>', { id_user: userId , id_location: locationId }); 
            });
        </script>
    </body>
</html>
