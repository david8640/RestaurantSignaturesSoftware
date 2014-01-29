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
    <h2>Purchase Orders</h2>
    <form id="purchaseOrders" action="" method="post" accept-charset="utf-8">
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
            foreach ($purchaseOrders as $p) { 
                $total = $p->getSubtotal() + $p->getShipping() + $p->getTaxes();
                ?>
                <tr>
                    <td><?php 
                        echo Form::hidden('poNumber[' . $index . ']', $p->getPONumber());
                        echo $p->getSupplierName(); 
                    ?></td>
                    <td><?php echo Form::input('supplierPONumber[' . $index . ']', $p->getSupplierPONumber()); ?></td>
                    <td><?php echo Form::input('subtotal[' . $index . ']', $p->getSubtotal(), array('id' => 'subtotal_' . $p->getPONumber(), 'disabled' => 'disabled')); ?></td>
                    <td><?php echo Form::input('shipping[' . $index . ']', $p->getShipping(), array('id' => 'shipping_' . $p->getPONumber())); ?></td>
                    <td><?php echo Form::input('taxes[' . $index . ']', $p->getTaxes(), array('id' => 'taxes_' . $p->getPONumber())); ?></td>
                    <td><?php echo Form::input('totalCost[' . $index . ']', $total, array('id' => 'totalCost_' . $p->getPONumber(), 'disabled' => 'disabled')); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php
            echo Form::label('Total', 'Total: ');
            echo Form::input('total', 0, array('id' => 'total', 'disabled' => 'disabled'));
        ?>
        <span id="orderStep2SubmitBt">
            <input type="button" value="Next" onclick="submitForm('<?php echo URL::site('order/nextStep2'); ?>')"/>
            <input type="button" value="Save" onclick="submitForm('<?php echo URL::site('order/saveStep2'); ?>')"/>
        </span>
    <?php echo Form::close(); ?>
</div>
<script>
    function submitForm(actionUrl) {
        $('#orderForm').attr('action', actionUrl);
        $('#orderForm').submit();
    }
   
    $(document).ready(function() {
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
        var subtotal = parseInt($('#subtotal_' + poNumber).val());
        var shipping = parseInt($('#shipping_' + poNumber).val());
        var taxes = parseInt($('#taxes_' + poNumber).val());
        var prevTotal = parseInt($('#totalCost_' + poNumber).val());
        
        $('#totalCost_' + poNumber).val(subtotal + shipping + taxes);
        $('#total').val($('#total').val() - prevTotal);
    }
    
</script>
