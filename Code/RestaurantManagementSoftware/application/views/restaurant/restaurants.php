<?php
/*
 *  <copyright file="restaurants.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The view that print all the restaurants.</summary>
 */
$count = 0;
?>
<h2>Restaurants</h2>
<table id="restaurants">
    <tr>
        <th class="id">Id</th>
        <th>Name</th>
        <th>Address</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($restaurants as $r) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $r->getId(); ?></td>
            <td><?php echo $r->getName(); ?></td>
            <td><?php echo $r->getAddress(); ?></td>
            <td><?php echo HTML::anchor('restaurant/edit/'.$r->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('restaurant/delete/'.$r->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">
    <?php echo HTML::anchor('restaurant/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
