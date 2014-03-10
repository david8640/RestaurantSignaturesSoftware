<?php
/*
 *  <copyright file="suppliersProducts.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-06</date>
 *  <summary>The view that print all the suppliers products.</summary>
 */
?>
<h2>
    <div class="left">Suppliers' Products</div>
    <div class="button">    
        <?php echo HTML::anchor('supplierProduct/create', '', array('class' => 'button_add', 'name' => 'Add')); ?>
    </div>
</h2>
<table id="suppliersProducts">
    <thead>
        <tr>
            <th>Supplier Id</th>
            <th>Supplier Name</th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Unit Of Measurement</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><input class="search_init" type="text" value="Search id" name="search_id"></th>
            <th><input class="search_init" type="text" value="Search product id" name="search_product_id"></th>
            <th><input class="search_init" type="text" value="Search supplier" name="search_supplier"></th>
            <th><input class="search_init" type="text" value="Search product" name="search_product"></th>
            <th><input class="search_init" type="text" value="Search price" name="search_cost_per_unit"></th>
            <th><input class="search_init" type="text" value="Search unit of measurement" name="search_unit_of_measurement"></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($suppliersProducts as $sp) { ?>
            <tr>
                <td><?php echo $sp->getSupplierID(); ?></td>
                <td><?php echo $sp->getProductID(); ?></td>
                <td><?php echo $sp->getSupplierName(); ?></td>
                <td><?php echo $sp->getProductName(); ?></td>
                <td><?php echo $sp->getCostPerUnit(); ?></td>
                <td><?php echo $sp->getUnitOfMeasurement(); ?></td>
                <td><?php echo HTML::anchor('supplierProduct/edit/'.$sp->getSupplierID().'_'.$sp->getProductID(), '', array('class' => 'button_edit', 'name' => 'Edit')); ?></td>
                <td><?php echo HTML::anchor('supplierProduct/delete/'.$sp->getSupplierID().'_'.$sp->getProductID(), '', array('class' => 'button_delete', 'name' => 'Delete')); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    var nbOfHiddenColumn = 2;
    
    $(document).ready(function() {
        var oTable = $('#suppliersProducts').dataTable( {
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [1] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [6] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [7] }
                ]});
            
        $("tfoot input").keyup( function () {
            oTable.fnFilter(this.value, $("tfoot input").index(this) + nbOfHiddenColumn);
        });
    });
</script>
