<?php

/* 
 *  <copyright file="restaurant_users.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>Edit a user access for a specific restaurant.</summary>
 */
if (!isset($restaurantUsers)) {
    $restaurantUsers = array();
}  

if (!isset($pageName)) {
    $pageName = 'User Access Management';
}

if (!isset($submitAction)) {
    $submitAction = 'restaurantUser/save';
}

$count = 0;

?>
<div class="form_content" style="width:100%;">
    <h1><?php echo $pageName; ?></h1>
    <?php
    echo Form::open($submitAction);
    echo Form::hidden('id_restaurant', $id_restaurant);
    ?><table id="restaurants">
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Access</th>
        </tr>
        <?php foreach ($restaurantUsers as $ru) { 
            $count++;
            ?>
            <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
                <td><?php echo $ru->getIdUser();?></td>
                <td><?php echo $ru->getNameUser(); ?></td>
                <td><?php echo Form::checkbox('is_check[]', $ru->getIdUser(), $ru->getIsCheck() == 1); ?></td>
            </tr>
        <?php } ?>
    </table><?php
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>