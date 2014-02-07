<?php
/*
 *  <copyright file="suppliersProducts.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-06</date>
 *  <summary>The view that print all the suppliers products.</summary>
 */
$count = 0;
?>
<h2>Suppliers' Products</h2>
<table id="suppliersProducts">
    <tr>
        <th>Supplier Id</th>
        <th>Supplier Name</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Unit Of Measurement</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($suppliersProducts as $sp) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $sp->getSupplierID(); ?></td>
            <td><?php echo $sp->getSupplierName(); ?></td>
            <td><?php echo $sp->getProductID(); ?></td>
            <td><?php echo $sp->getProductName(); ?></td>
            <td><?php echo $sp->getCostPerUnit(); ?></td>
            <td><?php echo $sp->getUnitOfMeasurement(); ?></td>
            <td><?php echo HTML::anchor('supplierProduct/edit/'.$sp->getSupplierID().'_'.$sp->getProductID(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('supplierProduct/delete/'.$sp->getSupplierID().'_'.$sp->getProductID(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">    
    <?php echo HTML::anchor('supplierProduct/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
