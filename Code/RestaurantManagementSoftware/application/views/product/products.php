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
        <th>Category</th>
        <th>Unit Of Measurement</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($products as $p) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $p->getId(); ?></td>
            <td><?php echo $p->getName(); ?></td>
            <td><?php echo $p->getCategoryName(); ?></td>
            <td><?php echo $p->getUnitOfMeasurement(); ?></td>
            <td><?php echo HTML::anchor('product/edit/'.$p->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('product/delete/'.$p->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">    
    <?php echo HTML::anchor('product/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
