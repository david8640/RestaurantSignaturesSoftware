<?php
/*
 *  <copyright file="step3.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-24</date>
 *  <summary>The thrid step to order.</summary>
 */

if (!isset($purchaseOrders)) {
    $purchaseOrders = array();
}  

?>
<div>
    <h2>Step 3 : Review</h2>
    <form id="review" action="" method="post" accept-charset="utf-8">
        <div>
            <?php
            // Order Informations
            echo Form::hidden('orderId', $order->getOrderID());
            echo Form::hidden('restaurantId', $order->getRestaurantID());
            ?>
            <div class="restaurant">
                <?php echo 'Restaurant :' . $order->getRestaurantName(); ?>
            </div>
        </div>
        <?php 
        $index = 0;
        foreach ($purchaseOrders as $p) { ?>
            <div class="clear">
                <?php
                echo Form::hidden('poNumber[' . $index . ']', $p->getPOID());
                echo Form::hidden('idOrder[' . $index . ']', $p->getOrderID());
                echo Form::hidden('idSupplier[' . $index . ']', $p->getSupplierID());
                echo Form::hidden('supplierName[' . $index . ']', $p->getSupplierName());
                echo Form::hidden('supplierPONumber[' . $index . ']', $p->getSupplierPONumber());
                
                echo $p->getSupplierName() . ' : PO# ' . $p->getSupplierPONumber();
                ?>
            </div>
            <table border="1">
                <tr>
                    <th>Product</th>
                    <th>Unit</th>
                    <th>Cost/Unit</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                </tr>
                <?php 
                $itemIndex = 0;
                foreach ($p->getItems() as $item) { ?>
                    <tr>
                        <td>
                            <?php echo Form::hidden('poItemPOID[' . $index . '][' . $itemIndex . ']', $item->getPOID()); ?>
                            <?php echo Form::hidden('poItemProductID[' . $index . '][' . $itemIndex . ']', $item->getProductID()); ?>
                            <?php echo $item->getProductName(); ?>
                        </td>
                        <td><?php echo $item->getUnitOfMeasurement(); ?></td>
                        <td><?php 
                            echo Form::hidden('poItemCostPerUnit[' . $index . '][' . $itemIndex . ']', $item->getCostPerUnit());
                            echo $item->getCostPerUnit();
                         ?></td>
                        <td><?php 
                            echo Form::hidden('poItemQty[' . $index . '][' . $itemIndex . ']', $item->getQty()); 
                            echo $item->getQty(); 
                        ?></td> 
                        <td><?php echo $item->getSubtotal(); ?></td> 
                    </tr>
                    <?php
                    $itemIndex++;
                } ?>
            </table>
            <div class="clear"></div>
            <table class="poTotal">
                <tr>
                    <td class="label"><?php echo Form::label('subtotal[' . $index . ']', 'Subtotal :'); ?></td>
                    <td><?php
                        echo Form::hidden('subtotal[' . $index . ']', $p->getSubtotal(), array('id' => 'subtotal_' . $p->getPOID()));
                        echo $p->getSubtotal();
                    ?></td>
                </tr>
                <tr> 
                    <td class="label"><?php echo Form::label('shipping[' . $index . ']', 'Shipping :'); ?></td>
                    <td><?php
                        echo Form::hidden('shipping[' . $index . ']', $p->getShipping(), array('id' => 'shipping_' . $p->getPOID())); 
                        echo $p->getShipping();
                    ?></td>
                </tr>
                <tr>
                    <td class="label"><?php echo Form::label('taxes[' . $index . ']', 'Taxes :'); ?></td>
                    <td><?php
                        echo Form::hidden('taxes[' . $index . ']', $p->getTaxes(), array('id' => 'taxes_' . $p->getPOID()));
                        echo $p->getTaxes();
                    ?></td>
                </tr>
                <tr>
                    <td class="label"><?php echo Form::label('totalCost[' . $index . ']', 'Total :'); ?></td>
                    <td><?php
                        echo Form::hidden('totalCost[' . $index . ']', $p->getTotalCost(), array('id' => 'totalCost_' . $p->getPOID()));
                        echo $p->getTotalCost();
                    ?></td>
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
                echo Form::hidden('total', $order->getTotalCost(), array('id' => 'total'));
                echo $order->getTotalCost();
            ?>    
        </div>
        <div class="clear"></div>
        <span id="orderStep3SubmitBt">
            <input type="button" value="Submit" onclick="submitForm('<?php echo URL::site('order/saveStep2'); ?>')"/>
        </span>
    <?php echo Form::close(); ?>
</div>
