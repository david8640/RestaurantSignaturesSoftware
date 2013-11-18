<?php
/*
 *  <copyright file="categories.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>The view that print all the product categories.</summary>
 */
?>
<h2>Product Categories</h2>
<table border="1" id="productCategories">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Order</th>
        <th>Edit</th>
        <th>Remove</th>
    </tr>
    <?php foreach ($categories as $c) { ?>
        <tr>
            <td><?php echo $c->getId(); ?></td>
            <td><?php echo $c->getName(); ?></td>
            <td><?php echo ($c->getParentName() == NULL) ? 'none' :  $c->getParentName(); ?></td>
            <td><?php echo $c->getOrder(); ?></td>
            <td><?php echo HTML::anchor('productCategory/edit/'.$c->getId(), 'Edit'); ?></td>
            <td><?php echo HTML::anchor('productCategory/delete/'.$c->getId(), 'Delete'); ?></td>
        </tr>
    <?php } ?>
</table>
<?php echo HTML::anchor('productCategory/create', 'Add'); ?>
