<?php

/* 
 *  <copyright file="supplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>Add/Update a supplier.</summary>
 */
if (isset($feedbackMessage)) {
    $messages = $feedbackMessage;
} elseif (Session::instance()->get('feedbackMessage') != '') {
    $messages = Session::instance()->get_once('feedbackMessage');
} else {
    $messages = array();
}

foreach ($messages as $message):
    echo $message."<br/>";
endforeach;

if (!isset($supplier)) {
    $supplier = new Model_Supplier(-1, '', '', '', '');
}  

if (!isset($submitAction)) {
    $submitAction = 'supplier/add';
}

?>
<h1>Add Supplier</h1>
<?php
echo FORM::open($submitAction);
echo FORM::hidden('id', $supplier->getId()) . "<br/>";
echo FORM::label('name', 'Name :');
echo FORM::input('name', $supplier->getName()) . "<br/>";
echo FORM::label('contactName', 'Contact name :');
echo FORM::input('contactName', $supplier->getContactName()). "<br/>";
echo FORM::label('phoneNumber', 'Phone number :');
echo FORM::input('phoneNumber', $supplier->getPhoneNumber()). "<br/>";
echo FORM::label('faxNumber', 'Fax number :');
echo FORM::input('faxNumber', $supplier->getFaxNumber()). "<br/>";
echo FORM::submit(NULL, 'Save');
echo FORM::close();
?>  