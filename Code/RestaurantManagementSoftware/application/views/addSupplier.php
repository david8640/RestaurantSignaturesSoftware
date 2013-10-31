<?php

/* 
 *  <copyright file="addSupplier.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>Add a new supplier.</summary>
 */
?>
<h1>Add Supplier</h1>
<?php
echo form::open('supplier/add');
echo form::label('name', 'Name :');
echo form::input('name') . "<br/>";
echo form::label('contactName', 'Contact name :');
echo form::input('contactName'). "<br/>";
echo form::label('phoneNumber', 'Phone number :');
echo form::input('phoneNumber'). "<br/>";
echo form::label('faxNumber', 'Fax number :');
echo form::input('faxNumber'). "<br/>";
echo form::submit(NULL, "Add");
echo form::close();
?>  