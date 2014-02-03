<?php
/*
 *  <copyright file="products.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Omar Hijazi</author>
 *  <date>2014-01-29</date>
 *  <summary>The view that print all the products.</summary>
 */
$count = 0;
?>
<h2>Products</h2>
<table id="products">
    <tr>
        <th class="id">Id</th>
        <th>Name</th>
        <th>Product ID</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($products as $s) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $s->getId(); ?></td>
            <td><?php echo $s->getName(); ?></td>
            <td><?php echo $s->getProductID(); ?></td>
            <td><?php echo HTML::anchor('product/edit/'.$s->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('product/delete/'.$s->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">    
    <?php echo HTML::anchor('product/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
