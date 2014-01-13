<?php
/*
 *  <copyright file="categories.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>The view that print all the product categories.</summary>
 */
$count = 0;
?>
<h2>Product Categories</h2>
<table id="productCategories">
    <tr>
        <th class="id">Id</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Order</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($categories as $c) {
        $count++;
        ?>    
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $c->getId(); ?></td>
            <td><?php echo $c->getName(); ?></td>
            <td><?php echo ($c->getParentName() == NULL) ? 'none' :  $c->getParentName(); ?></td>
            <td><?php echo $c->getOrder(); ?></td>
            <td><?php echo HTML::anchor('productCategory/edit/'.$c->getId(), '', array('class' => 'button_edit')); ?></td>
            <td><?php echo HTML::anchor('productCategory/delete/'.$c->getId(), '', array('class' => 'button_delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">
    <?php echo HTML::anchor('productCategory/create', '', array('class' => 'button_add')); ?>
</div>