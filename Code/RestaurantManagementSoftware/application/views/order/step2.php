<?php
/*
 *  <copyright file="step2.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-24</date>
 *  <summary>The second step to order.</summary>
 */

if (!isset($purchaseOrders)) {
    $purchaseOrders = array();
}  

?>
<div>
    <h2>Step 2 : Purchase Orders</h2>
    <form id="purchaseOrders" action="" method="post" accept-charset="utf-8">
        <div>
            <?php
            // Step 1 - Informations
            // Order
            echo Form::hidden('orderId', $order->getOrderID());
            echo Form::hidden('restaurantId', $order->getRestaurantID());
            ?>
        </div>
        <table border="1">
            <tr>
                <th>Supplier</th>
                <th>PO#</th>
                <th>Subtotal</th>
                <th>Shipping</th>
                <th>Taxes</th>
                <th>Total</th>
            </tr>
            <?php 
            $index = 0;
            $total = 0;
            foreach ($purchaseOrders as $p) { 
                $poTotal = $p->getSubtotal() + $p->getShipping() + $p->getTaxes();
                $total += $poTotal;
                ?>
                <tr>
                    <td><?php
                        // Step 1 - Informations
                        // Purchase Order Item
                        // [BEGIN]
                        $itemIndex = 0;
                        foreach ($p->getItems() as $item) {
                            echo Form::hidden('poItemPOID[' . $index . '][' . $itemIndex . ']', $item->getPOID());
                            echo Form::hidden('poItemProductID[' . $index . '][' . $itemIndex . ']', $item->getProductID());
                            echo Form::hidden('poItemCostPerUnit[' . $index . '][' . $itemIndex . ']', $item->getCostPerUnit());
                            echo Form::hidden('poItemQty[' . $index . '][' . $itemIndex . ']', $item->getQty());
                            $itemIndex++;
                        }
                        // [END]
                        
                        echo Form::hidden('poNumber[' . $index . ']', $p->getPOID());
                        echo Form::hidden('idOrder[' . $index . ']', $p->getOrderID());
                        echo Form::hidden('idSupplier[' . $index . ']', $p->getSupplierID());
                        echo Form::input('supplierName[' . $index . ']', $p->getSupplierName(), array('readonly' => 'readonly'));
                    ?></td>
                    <td><?php echo Form::input('supplierPONumber[' . $index . ']', $p->getSupplierPONumber()); ?></td>
                    <td><?php echo Form::input('subtotal[' . $index . ']', $p->getSubtotal(), array('id' => 'subtotal_' . $p->getPOID(), 'readonly' => 'readonly')); ?></td>
                    <td><?php echo Form::input('shipping[' . $index . ']', $p->getShipping(), array('id' => 'shipping_' . $p->getPOID())); ?></td>
                    <td><?php echo Form::input('taxes[' . $index . ']', $p->getTaxes(), array('id' => 'taxes_' . $p->getPOID())); ?></td>
                    <td><?php echo Form::input('totalCost[' . $index . ']', $poTotal, array('id' => 'totalCost_' . $p->getPOID(), 'readonly' => 'readonly')); ?></td>
                </tr>
            <?php 
                $index++;
            } ?>
        </table>
        <?php
            echo Form::label('total', 'Total: ');
            echo Form::input('total', $total, array('id' => 'total', 'readonly' => 'readonly'));
        ?>
        <span id="orderStep2SubmitBt">
            <input type="button" value="Next" onclick="submitForm('<?php echo URL::site('order/nextStep2'); ?>')"/>
            <input type="button" value="Save" onclick="submitForm('<?php echo URL::site('order/saveStep2'); ?>')"/>
        </span>
    <?php echo Form::close(); ?>
</div>
<script>
    function submitForm(actionUrl) {
        $('#purchaseOrders').attr('action', actionUrl);
        $('#purchaseOrders').submit();
    }
   
    $(document).ready(function() {        
        //// Hide the locations to avoid changing the selection while the creation
        // of an order.
        $('#locations').hide();
        
        bindEvents();
    });
        
    function bindEvents() {
        $('input[id*=shipping_], input[id*=taxes_]').each(function() {
          var id = $(this).attr('id');
          var partOfId = id.split('_');
          var poNumber = partOfId[1];
          $('#'+id).focusout(function() { update(poNumber); });
       });

        /*order.forEach(function(e) {
            $('#shipping_' + e.productId + '_' + e.supplierId).focusout(function() { updateCost(e.productId, e.supplierId); });
            $('#taxes_' + e.productId + '_' + e.supplierId).focusout(function() { updateQty(e.productId, e.supplierId); });
        });*/     
    }
   
    function update(poNumber) {
        // Update total for current po
        var subtotal = parseFloat($('#subtotal_' + poNumber).val());
        var shipping = parseFloat($('#shipping_' + poNumber).val());
        var taxes = parseFloat($('#taxes_' + poNumber).val());        
        
         $('#totalCost_' + poNumber).val(
                ((isNaN(subtotal)) ? 0 : subtotal) + 
                ((isNaN(shipping)) ? 0 : shipping) + 
                ((isNaN(taxes)) ? 0 : taxes));
        
        // Update global total
        var total = 0;
        $('input[id*=totalCost_]').each(function() {
             total += parseInt($(this).val());
        });
        $('#total').val(total);
    }
    
</script>
