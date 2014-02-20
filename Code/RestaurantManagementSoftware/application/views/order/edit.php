<?php
/*
 *  <copyright file="edit.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The page to edit the state of a purchase order.</summary>
 */

if (!isset($purchaseOrders)) {
    $purchaseOrders = array();
}  

?>
<div>
    <h2>Edit Purchase Orders</h2>
    <?php echo Form::open('order/updateState'); ?>
        <div>
            <?php
            // Step 1 - Informations
            echo Form::hidden('originAction', $originAction);
            echo Form::hidden('orderId', $order->getOrderID());
            ?>
        </div>
        <div class="restaurant">
                <?php echo 'Restaurant :' . $order->getRestaurantName(); ?>
        </div>
        <table border="1">
            <tr>
                <th>Supplier</th>
                <th>PO#</th>
                <th>Subtotal</th>
                <th>Shipping</th>
                <th>Taxes</th>
                <th>Total</th>
                <th>State</th>
            </tr>
            <?php 
            $index = 0;
            $total = 0;
            foreach ($purchaseOrders as $p) { 
                $poTotal = $p->getSubtotal() + $p->getShipping() + $p->getTaxes();
                $total += $poTotal;
                ?>
                <tr>
                    <td><?php echo $p->getSupplierName(); ?></td>
                    <td><?php echo $p->getSupplierPONumber(); ?></td>
                    <td><?php echo number_format($p->getSubtotal(), 2); ?></td>
                    <td><?php echo number_format($p->getShipping(), 2); ?></td>
                    <td><?php echo number_format($p->getTaxes(), 2); ?></td>
                    <td><?php echo number_format($poTotal, 2); ?></td>
                    <td>
                        <?php 
                        if ($p->getState() == 3) {
                            echo $p->getStateName();
                        } else { 
                            echo Form::hidden('poId[' . $index . ']', $p->getPOID());
                            ?>
                            <select name="state[<?php echo $index; ?>]">
                                <option value="1"<?php echo (($p->getState() == 1) ? "selected" : ""); ?> >Ordered</option>    
                                <option value="2"<?php echo (($p->getState() == 2) ? "selected" : ""); ?> >Shipped</option>    
                                <option value="3">Received</option>    
                            </select>
                        <?php } ?>
                    </td>
                </tr>
            <?php 
                $index++;
            } ?>
        </table>
        <div class="total">
            <?php
                echo Form::label('total', 'Total: ');
                echo number_format($total, 2);
            ?>
        </div>
        <div class="clear"></div>
        <span id="orderStep2SubmitBt">
            <?php echo Form::submit(NULL, 'Save'); ?>
        </span>
    <?php echo Form::close(); ?>
</div>