<?php

/* 
 *  <copyright file="supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Omar Hijazi</author>
 *  <date>2014-02-01</date>
 *  <summary>Add/Update a product.</summary>
 */
if (!isset($product)) {
    $product = new Model_Product(-1, '', '', '', ''); 
}  

if (!isset($pageName)) {
    $pageName = 'Add Product';
}

if (!isset($submitAction)) {
    $submitAction = 'product/add';
}

?>
<div class="form_content">
    <h1><?php echo $pageName; ?></h1>
    <?php
    echo Form::open($submitAction);
    echo Form::hidden('product_id', $product->getId()) . "<br/>";
    echo Form::label('name', 'Name :');
    echo Form::input('name', $product->getName()) . "<br/>";
    echo Form::label('id_category', 'Category :');
    ?>
    <select name='id_category' id="id_category">
        <option value='-1'>None</option>
        <?php foreach ($categories as $c) { 
            $selectionText = ($c->getId() == $product->getCategoryID()) ? 'selected="selected"' : ''; ?>
        <option value='<?php echo $c->getId(); ?>' <?php echo $selectionText; ?> >
            <?php echo $c->getName(); ?>
        </option>
        <?php } ?>
    </select> </br>
    <?php
    echo Form::label('unit_of_measurement', 'Unit Of Measurement :');
    echo Form::input('unit_of_measurement', $product->getUnitOfMeasurement()). "<br/>";
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>