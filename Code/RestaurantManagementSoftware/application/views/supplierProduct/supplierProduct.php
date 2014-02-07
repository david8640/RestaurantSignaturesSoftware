<?php

/* 
 *  <copyright file="suppliersProduct.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-06</date>
 *  <summary>Add/Update a supplier's product.</summary>
 */
if (!isset($supplierProduct)) {
    $supplierProduct = new Model_SupplierProduct(-1, '', -1, '', '', '', 0);
}

if (!isset($pageName)) {
    $pageName = "Add Supplier's Product";
}

if (!isset($submitAction)) {
    $submitAction = 'supplierProduct/add';
}

?>
<div class="form_content">
    <h1><?php echo $pageName; ?></h1>
    <?php
    echo Form::open($submitAction);
    echo Form::label('supplier_id', 'Supplier :');
    if (isset($suppliers)) { ?>
        <select name='supplier_id' id="supplier_id">
            <?php foreach ($suppliers as $s) { 
                $selectionText = ($s->getId() == $supplierProduct->getSupplierID()) ? 'selected="selected"' : ''; ?>
            <option value='<?php echo $s->getId(); ?>' <?php echo $selectionText; ?> >
                <?php echo $s->getName(); ?>
            </option>
            <?php } ?>
        </select> </br><?php
    } else {
        echo Form::hidden('supplier_id', $supplierProduct->getSupplierID());
        echo Form::input('supplier_name', $supplierProduct->getSupplierName(), array('readonly' => 'readonly'));
    }
    
    echo Form::label('product_id', 'Product :');
    if (isset($suppliers)) { ?>
        <select name='product_id' id="product_id">
            <?php foreach ($products as $p) { 
                $selectionText = ($p->getId() == $supplierProduct->getProductID()) ? 'selected="selected"' : ''; ?>
            <option value='<?php echo $p->getId(); ?>' <?php echo $selectionText; ?> >
                <?php echo $p->getName(); ?>
            </option>
            <?php } ?>
        </select> </br> <?php
    } else {
        echo Form::hidden('product_id', $supplierProduct->getProductID());
        echo Form::input('product_name', $supplierProduct->getProductName(), array('readonly' => 'readonly'));
    }
    echo Form::label('price', 'Price :');
    echo Form::input('price', $supplierProduct->getCostPerUnit(), array('id' => 'price')) . "<br/>";
    echo Form::label('unit_of_measurement', 'Unit Of Measurement :');
    echo Form::input('unit_of_measurement', $supplierProduct->getUnitOfMeasurement()). "<br/>";
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>
<script>
    $(document).ready(function() {
        fixFormat();
        $('#price').focusout(function() {
            fixFormat();
        });
    });
    
    // Set the number of digits to 2
    function fixFormat() {
        $price = new Number($('#price').val());
        $('#price').val($price.toFixed(2));
    }
</script>
    