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

if (!isset($restaurants)) {
    $restaurants = array();
}  

if (!isset($productsOrdered)) {
    $productsOrdered = array();
}

if (!isset($orderId)) {
    $orderId = -1;
}

?>
<div>
    <h2>Step 1 : Choose Products</h2>
    <div class='leftcolumn'>
        <h3>Products</h3>
        <table id="suppliers_products" border="1">
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Unit</th>
                <th>Cost/Unit</th>
                <th>Order</th>
            </tr>
            <?php foreach ($products as $p) { ?>
                <tr>
                    <td><?php echo $p->getProductName(); ?></td>
                    <td><?php echo $p->getSupplierName(); ?></td>
                    <td><?php echo $p->getUnitOfMeasurement(); ?></td>
                    <td><?php echo number_format($p->getCostPerUnit(), 2); ?></td>
                    <td><input type='button' value='Add' onclick="add(<?php echo $p->getProductID(); ?>, '<?php echo $p->getProductName(); ?>', <?php echo $p->getSupplierID(); ?>, '<?php echo $p->getSupplierName(); ?>', '<?php echo $p->getUnitOfMeasurement(); ?>', <?php echo $p->getCostPerUnit(); ?>, <?php echo $p->getQty(); ?>);"/></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class='rightcolumn'>
        <h3>Order</h3>
        <form id="orderForm" action="" method="post" accept-charset="utf-8">
            <?php
                echo Form::hidden('originAction', $originAction);
                echo Form::hidden('orderId', $orderId);
                echo Form::hidden('locationName', '', array('id' => 'locationName'));
                echo Form::Label('Restaurant', 'Restaurant: '); 
            ?>
            <select id="locationId" name="locationId">
                <?php foreach ($restaurants as $r) { ?>
                    <option value="<?php echo $r->getId(); ?>" <?php echo (($r->getId() == $global_selected_location) ? 'selected': ''); ?>>
                        <?php echo $r->getName(); ?>
                    </option>
                <?php } ?>
            </select>
            <table id="order" border="1">
            </table>
            <div class="total">
                <?php
                    echo Form::label('Subtotal', 'Subtotal: ');
                    echo Form::hidden('subtotal', 0, array('id' => 'subtotal'));
                ?>
                <span id="subtotalVal"></span>
            </div>
            <div class="clear"></div>
            <span id="orderStep1SubmitBt">
                <input type="button" value="Next" onclick="submitForm('<?php echo URL::site('order/nextStep1'); ?>')"/>
                <input type="button" value="Save" onclick="submitForm('<?php echo URL::site('order/saveStep1'); ?>')"/>
            </span>
        <?php echo Form::close(); ?>
    </div>
</div>
<script>
    function submitForm(actionUrl) {
        $('#orderForm').attr('action', actionUrl);
        $('#orderForm').submit();
    }
    
    var order = [];
    
    $(document).ready(function() {
        // Put the location name in an hidden field to manipulate in other steps
        $('#locationName').val($('#locationId').find(":selected").text());
        $('#locationId').change(function() {
            $('#locationName').val($('#locationId').find(":selected").text());
        });
        
        // Hide the locations to avoid changing the selection while the creation
        // of an order.
        $('#locations').hide();
        
        addInitValues();
        display();
    });
        
    function bindEvents() {
        order.forEach(function(e) {
            $('#cost_' + e.productId + '_' + e.supplierId).focusout(function() { updateCost(e.productId, e.supplierId); });
            $('#qty_' + e.productId + '_' + e.supplierId).focusout(function() { updateQty(e.productId, e.supplierId); });
        });     
   }
    
    function addInitValues() {
        <?php 
        $addFunctions = '';
        foreach ($productsOrdered as $po) { 
            $addFunctions .= 'addItem('.$po->getProductID().', "'.$po->getProductName().
                                    '", '.$po->getSupplierID().', "'.$po->getSupplierName().
                                    '", "'.$po->getUnitOfMeasurement().'", "'.
                                    (($po->getCostPerUnit() == '') ? 0 : $po->getCostPerUnit()).'", "'.
                                    (($po->getQty()  == '') ? 0 : $po->getQty()).'");';
        }
        echo $addFunctions;
        ?>
    }
    
    function add(p_productId, p_productName, p_supplierId, p_supplierName, 
                    p_unit, p_costPerUnit, p_qty) {
        addItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                    p_unit, p_costPerUnit, p_qty);
        display();
    }
    
    function removeIt(p_productId, p_supplierId) {
        removeItem(p_productId, p_supplierId);
        display();
    }
    
    function updateCost(productId, supplierId) {
        var cost = $('#cost_' + productId + '_' + supplierId).val();
        updateItem(productId, supplierId, cost, -1);
        display();
    }
    
    function updateQty(productId, supplierId) {
        var qty = $('#qty_' + productId + '_' + supplierId).val();
        if (qty == 0) {
            removeItem(productId, supplierId);
        } else {
            updateItem(productId, supplierId, -1, qty);
        }
        display();
    }
    
    function display() {
        var tableRows = displayTableHeader();
        var subtotal = 0;
        var index = 0;
        order.forEach(function(e) { 
            // If it's not a valid number than put 0
            var productTotal = Number(e.costPerUnit * e.qty);
            subtotal += productTotal;
            var indexStr = '['+index+']';
            
            tableRows += '<tr>'
                +   '<td>'
                +       '<input type="hidden" value="' + e.productId + '" name="productId'+indexStr+'"/>'
                +       '<input type="hidden" value="' + e.productName + '" name="productName'+indexStr+'"/>'
                +       '<input type="hidden" value="' + e.supplierId + '" name="supplierId'+indexStr+'"/>'
                +       '<input type="hidden" value="' + e.supplierName + '" name="supplierName'+indexStr+'"/>'
                +       '<input type="hidden" value="' + e.unit + '" name="unit'+indexStr+'"/>'
                +       e.productName
                +   '</td>'
                +   '<td>'
                +       e.supplierName
                +   '</td>'
                +   '<td>' + e.unit + '</td>'
                +   '<td><input type="text" value="' + Number(e.costPerUnit).toFixed(2) + '" name="costPerUnit'+indexStr+'" id="cost_' + e.productId + '_' + e.supplierId + '"/></td>'
                +   '<td><input type="text" value="' + Number(e.qty).toFixed(2) + '" name="qty'+indexStr+'" id="qty_' + e.productId + '_' + e.supplierId + '"/></td>'
                +   '<td>' + productTotal.toFixed(2) + '</td>'
                +   '<td><input type="button" onclick="removeIt(' + e.productId + ',' + e.supplierId + ')" value="Remove" /></td>'
                +'</tr>';
        
            index++;
        });
        
        $('#order').html(tableRows);
        bindEvents();
        $('#subtotal').val(subtotal);
        $('#subtotalVal').text(Number(subtotal).toFixed(2));
    }
    
    function displayTableHeader() {
        return '<tr><th>Product</th><th>Supplier</th><th>Unit</th><th>Cost/Unit</th><th>Quantity</th><th>Cost</th><th>Remove</th></tr>';
    }
    
    function addItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                    p_unit, p_costPerUnit, p_qty) {
        var index = findItem(p_productId, p_supplierId);
        if (index === -1) {
            var obj = createItem(p_productId, p_productName, p_supplierId, p_supplierName, 
                                p_unit, p_costPerUnit, (p_qty === 0) ? 1 : p_qty);
            order.push(obj);
        } else {
            order[index].qty = parseInt(order[index].qty) + 1;
        }
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
                var cost = isNaN(p_costPerUnit) ? 0 : Number(p_costPerUnit);
                $('#cost_' + p_productId + '_' + p_supplierId).val(cost);
                order[index].costPerUnit = cost;
            }
            if (p_qty !== -1) {
                var qty = isNaN(p_qty) ? 0 : Number(p_qty);
                $('#qty_' + p_productId + '_' + p_supplierId).val(qty);
                order[index].qty = qty;
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
