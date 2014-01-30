<?php
/*
 *  <copyright file="restaurantOrders.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-24</date>
 *  <summary>The view that print all the orders of a restaurant.</summary>
 */
?>
<h2>Orders Placed</h2>
<table id="orders">
    <tr>
        <th class="id">Id</th>
        <th>Ordered Date</th>
        <th>Subtotal</th>
        <th>Shipping</th>
        <th>Taxes</th>
        <th>Total</th>
        <th>State</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($orders as $o) { ?>
        <tr>
            <td><?php echo $o->getOrderID(); ?></td>
            <td><?php echo $o->getDateOrdered(); ?></td>
            <td><?php echo $o->getSubtotal(); ?></td>
            <td><?php echo $o->getShippingCost(); ?></td>
            <td><?php echo $o->getTaxes(); ?></td>
            <td><?php echo $o->getTotalCost(); ?></td>
            <td><?php echo $o->getStateName(); ?></td>
            <td><?php /*echo HTML::anchor('order/edit/'.$o->getOrderID(), '', array('class' => 'button_edit', 'name' => 'Edit'));*/ ?></td>
            <td><?php /*echo HTML::anchor('order/delete/'.$o->getOrderID(), '', array('class' => 'button_delete', 'name' => 'Delete'));*/ ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">
    <?php echo HTML::anchor('order/getStep1', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
