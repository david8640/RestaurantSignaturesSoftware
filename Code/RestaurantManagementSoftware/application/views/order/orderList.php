<?php
/*
 *  <copyright file="orders.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Andrew Assaly</author>
 *  <date>2014-01-19</date>
 *  <summary>The view that print all the orders of given restaurants.</summary>
 */
?>
<h2>Orders Placed</h2>
<table id="orders">
    <tr>
        <th class="id">Id</th>
        <th>Supplier</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Cost</th>
        <th>Date Ordered</th>
        <th>Date Delivered</th>
        <th>Restaurant</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($orders as $o) { ?>
        <tr>
            <td><?php echo $o->getOrderID(); ?></td>
            <td><?php echo $o->getSupplier(); ?></td>
            <td><?php echo $o->getProduct(); ?></td>
            <td><?php echo $o->getPONumber(); ?></td>
            <td><?php echo $o->getQuantity(); ?></td>
            <td><?php echo $o->getCost(); ?></td>
            <td><?php echo $o->getDateOrdered(); ?></td>
            <td><?php echo $o->getDateDelivered(); ?></td>
            <td><?php echo HTML::anchor('order/edit/'.$o->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('order/delete/'.$o->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">
    <?php echo HTML::anchor('order/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
