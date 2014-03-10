<?php
/*
 *  <copyright file="categories.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>The view that print all the product categories.</summary>
 */
?>
<h2>
    <div class="left">Product Categories</div>
    <div class="button">
        <?php echo HTML::anchor('productCategory/create', '', array('class' => 'button_add')); ?>
    </div>
</h2>
<table id="productCategories">
    <thead>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Order</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
        <tr class="filter">
            <td><input class="search_init" type="text" value="Search id" name="search_id"></td>
            <td><input class="search_init" type="text" value="Search name" name="search_name"></td>
            <td><input class="search_init" type="text" value="Search parent" name="search_parent"></td>
            <td><input class="search_init" type="text" value="Search order" name="search_order"></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="id">Id</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Order</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($categories as $c) { ?>    
            <tr>
                <td><?php echo $c->getId(); ?></td>
                <td><?php echo $c->getName(); ?></td>
                <td><?php echo ($c->getParentName() == NULL) ? 'none' :  $c->getParentName(); ?></td>
                <td><?php echo $c->getOrder(); ?></td>
                <td><?php echo HTML::anchor('productCategory/edit/'.$c->getId(), '', array('class' => 'button_edit')); ?></td>
                <td><?php echo HTML::anchor('productCategory/delete/'.$c->getId(), '', array('class' => 'button_delete')); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    var nbOfHiddenColumn = 1;
    
    $(document).ready(function() {
        var oTable = $('#productCategories').dataTable( {
                "bSortCellsTop": true,
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [4] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [5] }
                ]});
            
        $("thead tr.filter input").keyup( function () {
            oTable.fnFilter(this.value, $("thead tr.filter input").index(this) + nbOfHiddenColumn);
        });
    });
</script>