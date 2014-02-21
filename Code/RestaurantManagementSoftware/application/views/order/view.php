<?php
/*
 *  <copyright file="view.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-15</date>
 *  <summary>The page that show all the informations of an order.</summary>
 */

if (!isset($purchaseOrders)) {
    $purchaseOrders = array();
}  

?>
<div>
    <h2>View Order</h2>
    <div>
        <?php echo Form::hidden('originAction', $originAction); ?>
        <div class="restaurant">
            <?php echo 'Restaurant :' . $order->getRestaurantName(); ?>
        </div>
    </div>
    <?php 
    $index = 0;
    foreach ($purchaseOrders as $p) { ?>
        <div class="clear">
            <div><?php echo $p->getSupplierName() . ' : PO# ' . $p->getSupplierPONumber(); ?></div>
            <div><?php echo 'State : ' . $p->getStateName(); ?></div>
        </div>
        <table>
            <tr>
                <th>Product</th>
                <th>Unit</th>
                <th>Cost/Unit</th>
                <th>Quantity</th>
                <th>Cost</th>
            </tr>
            <?php 
            $itemIndex = 0;
            $count = 0;
            foreach ($p->getItems() as $item) { 
                $count++;
                ?>
                <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
                    <td><?php echo $item->getProductName(); ?> </td>
                    <td><?php echo $item->getUnitOfMeasurement(); ?></td>
                    <td><?php echo number_format($item->getCostPerUnit(), 2); ?></td>
                    <td><?php echo number_format($item->getQty(), 0); ?></td> 
                    <td><?php echo number_format($item->getSubtotal(), 2); ?></td> 
                </tr>
                <?php
                $itemIndex++;
            } ?>
        </table>
        <div class="clear"></div>
        <table class="poTotal">
            <tr>
                <td class="label"><?php echo Form::label('subtotal[' . $index . ']', 'Subtotal :'); ?></td>
                <td><?php echo number_format($p->getSubtotal(), 2); ?></td>
            </tr>
            <tr> 
                <td class="label"><?php echo Form::label('shipping[' . $index . ']', 'Shipping :'); ?></td>
                <td><?php echo number_format($p->getShipping(), 2); ?></td>
            </tr>
            <tr>
                <td class="label"><?php echo Form::label('taxes[' . $index . ']', 'Taxes :'); ?></td>
                <td><?php echo number_format($p->getTaxes(), 2); ?></td>
            </tr>
            <tr>
                <td class="label"><?php echo Form::label('totalCost[' . $index . ']', 'Total :'); ?></td>
                <td><?php echo number_format($p->getTotalCost(), 2); ?></td>
            </tr>
        </table>
        <div class="clear"></div>
    <?php 
        $index++;
    } ?>
    <div class="clear"></div>
    <div class="orderTotal">
        <?php
            echo Form::label('total', 'Total: ');
            echo number_format($order->getTotalCost(), 2);
        ?>    
    </div>
    <div class="clear"></div>
    <div class="button_back">
        <input type="button" value="Back" onClick="document.location.href='<?php echo URL::site('order/'.$originAction); ?>';">
    </div>
</div>
