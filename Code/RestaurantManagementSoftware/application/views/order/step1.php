<?php
/*
 *  <copyright file="step1.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-24</date>
 *  <summary>The first step to order.</summary>
 */

if (!isset($products)) {
    $products = array();
}  

if (!isset($productsOrdered)) {
    $productsOrdered = array();
}
?>
<div>
    <div>
        <h2>Products</h2>
        <table id="suppliers_products">
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Unit</th>
                <th>Cost/Unit</th>
                <th>Quantity</th>
                <th>Order</th>
            </tr>
            <?php foreach ($products as $p) { ?>
                <tr>
                    <td><?php echo $p->getProductName(); ?></td>
                    <td><?php echo $p->getSupplierName(); ?></td>
                    <td><?php echo $p->getUnit(); ?></td>
                    <td><?php echo $p->getCostPerUnit(); ?></td>
                    <td><?php echo Form::input('qty', $p->getQty()); ?></td>
                    <td><input onclick="addItem(
                                <?php echo $p-getProductID(); ?>, 
                                '<?php echo $p-getProductName(); ?>', 
                                <?php echo $p-getSupplierID(); ?>, 
                                '<?php echo $p-getSupplierName(); ?>', 
                                '<?php echo $p-getUnit(); ?>', 
                                <?php echo $p-getCostPerUnit(); ?>, 
                                <?php echo $p-getQty(); ?>);"/></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div>
        <h2>Order</h2>
        <table id="order">
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Unit</th>
                <th>Cost/Unit</th>
                <th>Quantity</th>
                <th>Cost</th>
                <th>Remove</th>
            </tr>
            <?php echo Form::open(); ?>
                <span id="productsOrdered">
                </span>
            <?php echo Form::close(); ?>
        </table>
        <?php
            echo Form::input('subtotal', array('id' => 'subtotal', 'readonly' => 'readonly'));
        ?>
    </div>
</div>
<script>
    var order = [];
    
    $.ready(function() {
        addInitValues();
        display();
        
       $('input[id*=cost_]').each(function() {
          var id = $(this).attr('id');
          var partOfId = id.split('_');
          var productId = partOfId[1];
          var supplierId = partOfId[2];
          var cost = $(this).val();
          $('#'+id).focusout(function() { updateCost(cost, productId, supplierId); });
       });
               
       $('input[id*=qty_]').each(function() {
          var id = $(this).attr('id');
          var partOfId = id.split('_');
          var productId = partOfId[1];
          var supplierId = partOfId[2];
          var qty = $(this).val();
          $('#'+id).focusout(function() { updateQty(qty, productId, supplierId); });
       });       
    });
    
    function addInitValues() {
        <?php 
        $addFunctions = '';
        foreach ($productsOrdered as $po) { 
            $addFunctions .= 'addItem('.$po->getProductID().', '.$po->getProductName().
                                    ', '.$po->getSupplierID().', '.$po->getSupplierName().
                                    ', '.$po->getUnit().', '.$po->getCostPerUnit().
                                    ', '.$po->getQty().');';
        }
        echo $addFunctions;
        ?>
    }
    
    function updateCost(cost, productId, supplierId) {
        updateItem(productId, supplierId, cost, -1);
    }
    
    function updateQty(qty, productId, supplierId) {
        if (qty === 0) {
            removeItem(productId, supplierId);
        } else {
            updateItem(productId, supplierId, -1, qty);
        }
    }
    
    function display() {
        var tableRows = '';
        var subtotal = 0;
        var index = 0;
        order.forEach(function(e) {
            var productTotal = e.costPerUnit * e.qty;
            subtotal += productTotal;
            var indexStr = '['+index+']';
            
            tableRows += '<tr>'
                +   '<td>'
                +       '<input type="hidden" value="' + e.productId + '" name="productId'+indexStr+'"/>'
                +       '<input type="text" value="' + e.productName + '"/>'
                +   '</td>'
                +   '<td>'
                +       '<input type="hidden" value="' + e.supplierId + '" name="supplierId'+indexStr+'"/>'
                +       '<input type="text" value="' + e.supplierName + '"/>'
                +   '</td>'
                +   '<td><input type="text" value="' + e.unit + '"/></td>'
                +   '<td><input type="text" value="' + e.costPerUnit + '" name="costPerUnit'+indexStr+'" id="cost_' + e.productId + '_' + e.supplierId + '"/></td>'
                +   '<td><input type="text" value="' + e.qty + '" name="qty'+indexStr+'" id="qty_' + e.productId + '_' + e.supplierId + '"/></td>'
                +   '<td><input type="text" value="' + productTotal + '" readonly="readonly"/></td>'
                +   '<td><input onclick="removeItem(' + e.productId + ',' + e.supplierId + ')" value="Remove" /></td>'
                +'</tr>';
        
            index++;
        });
        $('#productsOrdered').val(tableRows);
        $('#subtotal').val(subtotal);
    }
    
    function addItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                    p_unit, p_costPerUnit, p_qty) {
        var obj = createItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                            p_unit, p_costPerUnit, p_qty);
        order.push(obj);
    }
    
    function removeItem(p_productId, p_supplierId) {
        order = order.filter(function (e) {
            return !(e.productId === p_productId && e.supplierId === p_supplierId);
        });
    }
    
    function updateItem(p_productId, p_supplierId, p_costPerUnit, p_qty) {
        var index = findItem(p_productId, p_supplierId);
        if (index !== -1) {
            if (p_costPerUnit !== -1) {
                order[index].costPerUnit = p_costPerUnit;
            }
            if (p_qty !== -1) {
                order[index].qty = p_qty;
            }
        }
    }
    
    function createItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                        p_unit, p_costPerUnit, p_qty) {
        return {
            productId : p_productId,
            productName : p_productName,
            supplierId : p_supplierId,
            supplierName : p_supplierName,
            unit : p_unit,
            costPerUnit : p_costPerUnit,
            qty : p_qty
        };
    }
    
    function findItem(p_productId, p_supplierId) {
        for (var i = 0; i !== order.length; i++) {
            if (order[i].productId === p_productId && order[i].supplierId === p_supplierId) {
                return i;
            }
        }
        return -1;
    }
</script>
