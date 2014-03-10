<?php
/*
 *  <copyright file="products.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Omar Hijazi</author>
 *  <date>2014-01-29</date>
 *  <summary>The view that print all the products.</summary>
 */
?>
<h2>
    <div class="left">Products</div> 
    <div class="button">    
        <?php echo HTML::anchor('product/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
    </div>
</h2>
<table id="products">
    <thead>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Unit Of Measurement</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
        <tr class="filter">
            <td><input class="search_init" type="text" value="Search id" name="search_id"></td>
            <td><input class="search_init" type="text" value="Search name" name="search_name"></td>
            <td><input class="search_init" type="text" value="Search category name" name="search_category_name"></td>
            <td><input class="search_init" type="text" value="Search unit of measurement" name="search_unit_of_measurement"></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Unit Of Measurement</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($products as $p) { ?>
            <tr>
                <td><?php echo $p->getId(); ?></td>
                <td><?php echo $p->getName(); ?></td>
                <td><?php echo $p->getCategoryName(); ?></td>
                <td><?php echo $p->getUnitOfMeasurement(); ?></td>
                <td><?php echo HTML::anchor('product/edit/'.$p->getId(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
                <td><?php echo HTML::anchor('product/delete/'.$p->getId(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    var nbOfHiddenColumn = 1;
    
    $(document).ready(function() {
        var oTable = $('#products').dataTable( {
                "bSortCellsTop": true,
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [4] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [5] }
                ]});
            
        $("thead tr.filter input").keyup( function () {
            oTable.fnFilter( this.value, $("thead tr.filter input").index(this) + nbOfHiddenColumn );
        });
    });
</script>
