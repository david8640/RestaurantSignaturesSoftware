<?php

/* 
 *  <copyright file="restaurant.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>Add/Update a restaurant.</summary>
 */
if (!isset($restaurant)) {
    $restaurant = new Model_Restaurant(-1, '', ''); 
}  

if (!isset($pageName)) {
    $pageName = 'Add Restaurant';
}

if (!isset($submitAction)) {
    $submitAction = 'restaurant/add';
}

?>
<div class="form_content">
    <h1><?php echo $pageName; ?></h1>
    <?php
    echo Form::open($submitAction);
    echo Form::hidden('id', $restaurant->getId()) . "<br/>";
    echo Form::label('name', 'Name :');
    echo Form::input('name', $restaurant->getName()) . "<br/>";
    echo Form::label('address', 'Address :');
    echo Form::input('address', $restaurant->getAddress()). "<br/>";
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>