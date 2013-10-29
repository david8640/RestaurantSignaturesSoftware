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
    <title>Users</title>
</head>
 
<body>
    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone Number</th>
        </tr>
        
        <?php
        foreach ($users as $u) { ?>
            <tr>
                <td><?php echo $u->getName(); ?></td>
            </tr>
        <?php } ?>
            
     </table>
</body>
</html>
