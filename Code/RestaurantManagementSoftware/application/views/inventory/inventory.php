<?php
/*
 *  <copyright file="inventory.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The view that print all the items of the inventory of a given restaurant.</summary>
 */
?>
<div>
    <h2>
        <div>Inventory of <?php echo $inventory->getRestaurantName(); ?></div>
    </h2>
    <table id="items">
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Product</th>
                <th>Unit of Measurement</th>
                <th>Cost/Unit</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><input class="search_init" type="text" value="Search supplier" name="search_supplier"></th>
                <th><input class="search_init" type="text" value="Search product" name="search_product"></th>
                <th><input class="search_init" type="text" value="Search unit of measurement" name="search_unit_of_measurement"></th>
                <th><input class="search_init" type="text" value="Search cost/unit" name="search_cost_per_unit"></th>
                <th><input class="search_init" type="text" value="Search qty" name="search_qty"></th>
            </tr>
        </tfoot> 
        <tbody>
            <?php 
            $index = 0;
            foreach ($inventory->getItems() as $i) { ?>
                <tr>
                    <td>
                        <?php 
                        echo Form::hidden('itemId['.$index.']', $i->getItemID());
                        echo Form::hidden('productId['.$index.']', $i->getProductID());
                        echo Form::hidden('productName['.$index.']', $i->getProductName());
                        echo Form::hidden('costPerUnit['.$index.']', $i->getCostPerUnit());

                        echo Form::hidden('unit['.$index.']', $i->getUnitOfMeasurement());
                        echo Form::hidden('supplierId['.$index.']', $i->getSupplierId());
                        echo Form::hidden('supplierName['.$index.']', $i->getSupplierName());
                        echo $i->getSupplierName(); 
                        ?>
                    </td>
                    <td><?php echo $i->getProductName(); ?></td>
                    <td><?php echo $i->getUnitOfMeasurement(); ?></td>
                    <td><?php echo $i->getCostPerUnit(); ?></td>
                    <td><?php echo Form::input('qty['.$index.']', $i->getQty(), array('class' => 'custom')); ?></td>
                </tr>
            <?php 
                $index++;
            } ?>
        </tbody>
    </table>
    <?php echo Form::open('inventory/update'); ?>
    <div>
        <?php 
            echo Form::hidden('originAction', $originAction);
            echo Form::hidden('inventoryId', $inventory->getId());
            echo Form::hidden('restaurantId', $inventory->getRestaurantId());
            echo Form::hidden('restaurantName', $inventory->getRestaurantName());
        ?>
    </div>
    <div class="clear"></div>
    <div style="display:none;" id="hiddenNodes"></div>
    <span id="SubmitBt">
    <?php
        echo Form::submit(NULL, 'Save');
        echo Form::close();
    ?>
    </span>
</div>
<script>
    $(document).ready(function() {
        var oTable = $('#items').dataTable( {
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSearchable": false, 
                      "aTargets": [4], 
                      "mData": function ( source, type, val ) {
                            if (type === 'set') {
                                 source.disp = val
                                 source.filter = $(val).attr('value');
                                 return;
                             }
                             else if (type === 'filter') {
                                 return source.filter;
                             }

                             return source.disp; 
                          }
                    }
                    
                ],
                "aoColumns": [
                    null,
                    null, 
                    null,
                    null,
                    { "sSortDataType": "dom-text", "sType": "numeric", "aTargets": [4] }
		]
        });
        
        // Add the nodes that are hidden to the form.
        $('form').submit( function() {
            $('#hiddenNodes').html($('input', oTable.fnGetNodes()));
            return true;
	} );

        // Filter on the according column.
        $("tfoot input").keyup( function () {
            oTable.fnFilter(this.value, $("tfoot input").index(this));
        });
        
        // Update the quatity cell in the datatable datas.
        $("tbody .custom").keyup(function () {
            var column = 4;
            var row = oTable.fnGetPosition($(this).closest('tr')[0]);
            
            oTable.fnUpdate("<input class=\"custom\" type=\"text\" value=\""+this.value+"\" name=\""+this.name+"\">", row, column);
        });
    });
    
    // Enable filtering on input textbox
    /* Create an array with the values of all the input boxes in a column */
    // Link : http://www.datatables.net/examples/plug-ins/dom_sort.html
    $.fn.dataTableExt.afnSortData['dom-text'] = function  ( oSettings, iColumn )
    {
        return $.map( oSettings.oApi._fnGetTrNodes(oSettings), function (tr, i) {
                return $('td:eq('+iColumn+') input', tr).val();
        } );
    }
</script>
