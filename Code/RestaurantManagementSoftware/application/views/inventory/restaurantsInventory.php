<?php
/*
 *  <copyright file="restaurantsInventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The view that print the inventory of all restaurants.</summary>
 */
?>
<h2>
    <div class="left">Inventories</div>
</h2>
<table id="inventories">
    <thead>
        <tr>
            <th>Restaurant</th>
            <th class="edit">Edit</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><input class="search_init" type="text" value="Search restaurant name" name="search_restaurant_name"></th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
        <?php 
        foreach ($restaurantsInventory as $ri) { ?>
            <tr>
                <td><?php echo $ri->getRestaurantName(); ?></td>
                <td><?php echo HTML::anchor('inventory/edit/'.$ri->getRestaurantID().'/findAll', '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var oTable = $('#inventories').dataTable( {
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "aTargets": [1] }
                ]});
            
        $("tfoot input").keyup( function () {
            oTable.fnFilter(this.value, $("tfoot input").index(this));
        });
    });
</script>
