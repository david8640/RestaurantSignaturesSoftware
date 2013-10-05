<?php

/* 
 *  <copyright file="suppliers.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>The view that print all the suppliers</summary>
 */

?>
<html>
<head>
    <title><?php echo $title ?></title>
</head>
 
<body>
    <h2><?php echo $title ?></h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone Number</th>
        </tr>
        
        <?php
        foreach ($suppliers as $s) { ?>
            <tr>
                <td><?php echo $s->getId(); ?></td>
                <td><?php echo $s->getName(); ?></td>
                <td><?php echo $s->getPhoneNumber(); ?></td>
            </tr>
        <?php } ?>
            
     </table>
</body>
</html>
