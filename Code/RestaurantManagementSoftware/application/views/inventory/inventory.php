<?php
/*
 *  <copyright file="inventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The view that print all the items of the inventory of a given restaurant.</summary>
 */
?>
<div>
    <?php echo Form::open('inventory/update'); ?>
    <h2>Inventory of <?php echo $inventory->getRestaurantName(); ?></h2>
    <div>
        <?php 
            echo Form::hidden('originAction', $originAction);
            echo Form::hidden('inventoryId', $inventory->getId());
            echo Form::hidden('restaurantId', $inventory->getRestaurantId());
            echo Form::hidden('restaurantName', $inventory->getRestaurantName());
        ?>
    </div>
    <table id="items">
        <tr>
            <th>Supplier</th>
            <th>Product</th>
            <th>Unit of Measurement</th>
            <th>Cost/Unit</th>
            <th>Quantity</th>
        </tr>
        <?php 
        $index = 0;
        $count = 0;
        foreach ($inventory->getItems() as $i) { 
            $count++;
            ?>
            <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
                <td>
                    <?php 
                    echo Form::hidden('itemId['.$index.']', $i->getItemID());
                    echo Form::hidden('productId['.$index.']', $i->getProductID());
                    echo Form::hidden('productName['.$index.']', $i->getProductName());
                    echo Form::hidden('costPerUnit['.$index.']', $i->getCostPerUnit());
                    
                    echo Form::hidden('unit['.$index.']', $i->getUnitOfMeasurement());
                    echo Form::hidden('supplierId['.$index.']', $i->getSupplierId());
                    echo Form::hidden('supplierName['.$index.']', $i->getSupplierName());
                    echo $i->getSupplierName(); 
                    ?>
                </td>
                <td><?php echo $i->getProductName(); ?></td>
                <td><?php echo $i->getUnitOfMeasurement(); ?></td>
                <td><?php echo $i->getCostPerUnit(); ?></td>
                <td><?php echo Form::input('qty['.$index.']', $i->getQty()); ?></td>
            </tr>
        <?php 
            $index++;
        } ?>
    </table>
    <span id="SubmitBt">
    <?php
        echo Form::submit(NULL, 'Save');
        echo Form::close();
    ?>
    </span>
</div>
