<?php
/*
 *  <copyright file="restaurants_users.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The view that print all the restaurants users.</summary>
 */
$count = 0;
?>
<h2>User Access Management</h2>
<?php
if (count($restaurantantsUsers) > 0) {
    $lastId = -1;
    foreach ($restaurantantsUsers as $ru) { 
        if ($ru->getIdRestaurant() != $lastId) {
            if ($lastId != -1 && $ru->getIdUser() != -1) {
                ?></table><?php
            }
            
            // Restaurant Name
            ?><table>
                <tr>
                    <td style="width: 20px;"><?php echo HTML::anchor('restaurantUser/edit/'.$ru->getIdRestaurant(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
                    <td><h3><?php echo $ru->getNameRestaurant(); ?></h3></td>
                </tr>
            </table><?php
            
            // User table
           if ($ru->getIdUser() != -1) { ?>
                <table id="restaurants_users">
                <tr>
                    <th class="id">Id</th>
                    <th>Name</th>
                </tr><?php
            } else {?>
                <div><?php echo 'There is no users that has access to this restaurant.' ?></div><?php 
            }

            $lastId = $ru->getIdRestaurant();
            $count = 0;
        }
        $count++;

        // Restaurant users
        if ($ru->getIdUser() != -1) {
            ?><tr <?php echo ($count % 2) ? 'class="odd"' : ''; ?> >
                <td><?php echo $ru->getIdUser(); ?></td>
                <td><?php echo $ru->getNameUser(); ?></td>
            </tr><?php 
        } 
    }
} else {
    ?><div><?php echo 'There is no users or restaurants' ?></div><?php
}
?>