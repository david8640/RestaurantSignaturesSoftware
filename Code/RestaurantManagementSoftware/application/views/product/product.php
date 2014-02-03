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
    echo Form::label('id_category', 'Category ID :');
    echo Form::input('id_category', $product->getProductID()). "<br/>";
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>