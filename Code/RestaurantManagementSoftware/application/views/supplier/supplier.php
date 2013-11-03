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
    $pageName = 'Add Supplier';
} else {
    $pageName = 'Edit Supplier';
}  

if (!isset($submitAction)) {
    $submitAction = 'supplier/add';
}

?>
<h1><?php echo $pageName; ?></h1>
<?php
echo form::open($submitAction);
echo form::hidden('id', $supplier->getId()) . "<br/>";
echo form::label('name', 'Name :');
echo form::input('name', $supplier->getName()) . "<br/>";
echo form::label('contactName', 'Contact name :');
echo form::input('contactName', $supplier->getContactName()). "<br/>";
echo form::label('phoneNumber', 'Phone number :');
echo form::input('phoneNumber', $supplier->getPhoneNumber()). "<br/>";
echo form::label('faxNumber', 'Fax number :');
echo form::input('faxNumber', $supplier->getFaxNumber()). "<br/>";
echo form::submit(NULL, 'Save');
echo form::close();
?>  