<?php

/* 
 *  <copyright file="supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>Add/Update a supplier.</summary>
 */
if (!isset($supplier)) {
    $supplier = new Model_Supplier(-1, '', '', '', ''); 
}  

if (!isset($pageName)) {
    $pageName = 'Add Supplier';
}

if (!isset($submitAction)) {
    $submitAction = 'supplier/add';
}

?>
<div class="form_content">
    <h1><?php echo $pageName; ?></h1>
    <?php
    echo Form::open($submitAction);
    echo Form::hidden('id', $supplier->getId()) . "<br/>";
    echo Form::label('name', 'Name :');
    echo Form::input('name', $supplier->getName()) . "<br/>";
    echo Form::label('contactName', 'Contact name :');
    echo Form::input('contactName', $supplier->getContactName()). "<br/>";
    echo Form::label('phoneNumber', 'Phone number :');
    echo Form::input('phoneNumber', $supplier->getPhoneNumber()). "<br/>";
    echo Form::label('faxNumber', 'Fax number :');
    echo Form::input('faxNumber', $supplier->getFaxNumber()). "<br/>";
    echo Form::submit(NULL, 'Save');
    echo Form::close();
    ?>
</div>