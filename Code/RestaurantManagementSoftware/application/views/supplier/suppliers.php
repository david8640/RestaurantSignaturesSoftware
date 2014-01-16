<?php
/*
 *  <copyright file="suppliers.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The view that print all the suppliers.</summary>
 */
$count = 0;
?>
<h2>Suppliers</h2>
<table id="suppliers">
    <tr>
        <th class="id">Id</th>
        <th>Name</th>
        <th>Contact Name</th>
        <th>Phone Number</th>
        <th>Fax Number</th>
        <th class="edit">Edit</th>
        <th class="remove">Remove</th>
    </tr>
    <?php foreach ($suppliers as $s) { 
        $count++;
        ?>
        <tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
            <td><?php echo $s->getId(); ?></td>
            <td><?php echo $s->getName(); ?></td>
            <td><?php echo $s->getContactName(); ?></td>
            <td><?php echo $s->getPhoneNumber(); ?></td>
            <td><?php echo $s->getFaxNumber(); ?></td>
            <td><?php echo HTML::anchor('supplier/edit/'.$s->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            <td><?php echo HTML::anchor('supplier/delete/'.$s->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
        </tr>
    <?php } ?>
</table>
<div class="button">    
    <?php echo HTML::anchor('supplier/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
</div>
