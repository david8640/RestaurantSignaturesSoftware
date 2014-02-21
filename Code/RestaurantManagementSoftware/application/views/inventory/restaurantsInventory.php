<?php
/*
 *  <copyright file="restaurantsInventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The view that print the inventory of all restaurants.</summary>
 */
?>
<h2>Inventories</h2>
<table id="inventories">
    <tr>
        <th>Restaurant</th>
        <th class="edit">Edit</th>
    </tr>
    <?php 
    $count = 0;
    foreach ($restaurantsInventory as $ri) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $ri->getRestaurantName(); ?></td>
            <td><?php echo HTML::anchor('inventory/edit/'.$ri->getRestaurantID().'/findAll', '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
        </tr>
    <?php } ?>
</table>
