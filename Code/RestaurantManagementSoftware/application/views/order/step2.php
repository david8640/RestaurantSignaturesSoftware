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
            echo Form::hidden('restaurantName', $order->getRestaurantName());
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
                            echo Form::hidden('poItemProductName[' . $index . '][' . $itemIndex . ']', $item->getProductName());
                            echo Form::hidden('poItemCostPerUnit[' . $index . '][' . $itemIndex . ']', $item->getCostPerUnit());
                            echo Form::hidden('poItemQty[' . $index . '][' . $itemIndex . ']', $item->getQty());
                            echo Form::hidden('poItemProductUnitOfMeasurement[' . $index . '][' . $itemIndex . ']', $item->getUnitOfMeasurement());
                            $itemIndex++;
                        }
                        // [END]
                        
                        echo Form::hidden('poNumber[' . $index . ']', $p->getPOID());
                        echo Form::hidden('idOrder[' . $index . ']', $p->getOrderID());
                        echo Form::hidden('idSupplier[' . $index . ']', $p->getSupplierID());
                        echo Form::input('supplierName[' . $index . ']', $p->getSupplierName(), array('readonly' => 'readonly'));
                    ?></td>
                    <td><?php echo Form::input('supplierPONumber[' . $index . ']', $p->getSupplierPONumber()); ?></td>
                    <td><?php echo Form::input('subtotal[' . $index . ']', $p->getSubtotal(), array('id' => 'subtotal_' . $p->getSupplierID(), 'readonly' => 'readonly')); ?></td>
                    <td><?php echo Form::input('shipping[' . $index . ']', $p->getShipping(), array('id' => 'shipping_' . $p->getSupplierID())); ?></td>
                    <td><?php echo Form::input('taxes[' . $index . ']', $p->getTaxes(), array('id' => 'taxes_' . $p->getSupplierID())); ?></td>
                    <td><?php echo Form::input('totalCost[' . $index . ']', $poTotal, array('id' => 'totalCost_' . $p->getSupplierID(), 'readonly' => 'readonly')); ?></td>
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
          var supplierId = partOfId[1];
          $('#'+id).focusout(function() { update(supplierId); });
       });    
    }
   
    function update(supplierId) {
        // Update total for current po
        var subtotal = parseFloat($('#subtotal_' + supplierId).val());
        
        var shipping = isNaN($('#shipping_' + supplierId).val()) ? 0 : Number($('#shipping_' + supplierId).val());
        $('#shipping_' + supplierId).val(shipping);
        
        var taxes = isNaN($('#taxes_' + supplierId).val()) ? 0 : Number($('#taxes_' + supplierId).val());
        $('#taxes_' + supplierId).val(taxes);    
        
         $('#totalCost_' + supplierId).val(
                ((isNaN(subtotal)) ? 0 : subtotal) + 
                ((isNaN(shipping)) ? 0 : shipping) + 
                ((isNaN(taxes)) ? 0 : taxes));
        
        // Update global total
        var total = 0;
        $('input[id*=totalCost_]').each(function() {
             total += parseFloat($(this).val());
        });
        $('#total').val(total);
    }
    
</script>
