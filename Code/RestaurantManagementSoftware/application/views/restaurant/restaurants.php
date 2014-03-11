<?php
/*
 *  <copyright file="restaurants.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The view that print all the restaurants.</summary>
 */
?>
<h2>
    <div class="left">Restaurants</div>
    <div class="button">
        <?php echo HTML::anchor('restaurant/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
    </div>
</h2>
<table id="restaurants">
    <thead>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Address</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
        <tr class="filter">
            <td><input class="search_init" type="text" value="Search id" name="search_id"></td>
            <td><input class="search_init" type="text" value="Search name" name="search_name"></td>
            <td><input class="search_init" type="text" value="Search address" name="search_address"></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Address</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($restaurants as $r) { ?>
            <tr>
                <td><?php echo $r->getId(); ?></td>
                <td><?php echo $r->getName(); ?></td>
                <td><?php echo $r->getAddress(); ?></td>
                <td><?php echo HTML::anchor('restaurant/edit/'.$r->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
                <td><?php echo HTML::anchor('restaurant/delete/'.$r->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    var nbOfHiddenColumn = 1;
    
    $(document).ready(function() {
        var oTable = $('#restaurants').dataTable( {
            "bSortCellsTop": true,
            "bStateSave": true,
            "bAutoWidth": false,
            "aoColumnDefs": [
                { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                { "bSortable": false, "bSearchable": false, "aTargets": [3] },
                { "bSortable": false, "bSearchable": false, "aTargets": [4] }
            ],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
            
        $("thead tr.filter input").keyup( function () {
            oTable.fnFilter( this.value, $("thead tr.filter input").index(this) + nbOfHiddenColumn );
        });
    });
</script>
