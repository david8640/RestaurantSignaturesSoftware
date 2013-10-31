<?php
/*
 *  <copyright file="suppliers.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The view that print all the suppliers.</summary>
 */
?>
<h2>Suppliers</h2>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Contact Name</th>
        <th>Phone Number</th>
        <th>Fax Number</th>
        <th>Edit</th>
        <th>Remove</th>
    </tr>
    <?php foreach ($suppliers as $s) { ?>
        <tr>
            <td><?php echo $s->getId(); ?></td>
            <td><?php echo $s->getName(); ?></td>
            <td><?php echo $s->getContactName(); ?></td>
            <td><?php echo $s->getPhoneNumber(); ?></td>
            <td><?php echo $s->getFaxNumber(); ?></td>
            <td><?php echo HTML::anchor('supplier/edit/'.$s->getId(), 'Edit'); ?></td>
            <td><?php echo HTML::anchor('supplier/delete/'.$s->getId(), 'Delete'); ?></td>
        </tr>
    <?php } ?>
</table>
<?php echo HTML::anchor('supplier/create', 'Add'); ?>
