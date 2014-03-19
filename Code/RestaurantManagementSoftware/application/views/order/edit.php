<?php
/*
 *  <copyright file="edit.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-02-20</date>
 *  <summary>The page to edit the state of a purchase order.</summary>
 */

if (!isset($purchaseOrders)) {
    $purchaseOrders = array();
}  

?>
<div>
    <h2>Edit Purchase Orders</h2>
    <div class="restaurant">
        <?php echo 'Restaurant: ' . $order->getRestaurantName(); ?>
    </div>
    <?php echo Form::open('order/updateState'); ?>
        <table id="poEdit">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>PO#</th>
                    <th>Subtotal</th>
                    <th>Shipping</th>
                    <th>Taxes</th>
                    <th>Total</th>
                    <th>State</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Supplier</th>
                    <th>PO#</th>
                    <th>Subtotal</th>
                    <th>Shipping</th>
                    <th>Taxes</th>
                    <th>Total</th>
                    <th>State</th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                $index = 0;
                $total = 0;
                foreach ($purchaseOrders as $p) { 
                    $poTotal = $p->getSubtotal() + $p->getShipping() + $p->getTaxes();
                    $total += $poTotal;
                    ?>
                    <tr>
                        <td><?php 
                            if ($p->getState() != 3) {
                                echo Form::hidden('poId[' . $index . ']', $p->getPOID());
                            }
                            echo $p->getSupplierName(); 
                        ?></td>
                        <td><?php echo $p->getSupplierPONumber(); ?></td>
                        <td><?php echo number_format($p->getSubtotal(), 2); ?></td>
                        <td><?php echo number_format($p->getShipping(), 2); ?></td>
                        <td><?php echo number_format($p->getTaxes(), 2); ?></td>
                        <td><?php echo number_format($poTotal, 2); ?></td>
                        <td>
                            <select name="state[<?php echo $index; ?>]" class="custom" <?php echo (($p->getState() == 3) ? "disabled=\"disabled\"" : ""); ?> >
                                <option value="1" <?php echo (($p->getState() == 1) ? "selected" : ""); ?> >Ordered</option>    
                                <option value="2" <?php echo (($p->getState() == 2) ? "selected" : ""); ?> >Shipped</option>    
                                <option value="3" <?php echo (($p->getState() == 3) ? "selected" : ""); ?> >Received</option>    
                            </select>
                        </td>
                    </tr>
                <?php 
                    if ($p->getState() != 3) {
                        $index++;
                    }
                } ?>
            </tbody>
        </table>
        <div>
            <?php
            // Step 1 - Informations
            echo Form::hidden('originAction', $originAction);
            echo Form::hidden('orderId', $order->getOrderID());
            ?>
        </div>
        <div class="total">
            <?php
                echo Form::label('total', 'Total: ');
                echo number_format($total, 2);
            ?>
        </div>
        <div class="clear"></div>
        <span class="rightSaveBt">
            <?php echo Form::submit(NULL, 'Save'); ?>
        </span>
    <?php echo Form::close(); ?>
</div>
<script>
    $(document).ready(function() {
        var oTable = $('#poEdit').dataTable( {
                "bSortCellsTop": true,
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false,
                "bStateSave": true,
                "bAutoWidth": false,
                "bDeferRender": true,
                // Remove state saving for the order's state filter
                "fnStateLoadParams": function (oSettings, oData) {
                    oData.oSearch.sSearch = "";
                    return false;
                },
                "aoColumns": [
                    null,
                    null, 
                    null,
                    null,
                    null,
                    null,
                    { "sSortDataType": "dom-select" }
		]
        });

        // Filter on the according column.
        $("thead tr.filter input").keyup( function () {
            oTable.fnFilter(this.value, $("thead tr.filter input").index(this));
        });
        
        // Filter the order's state column.
        $('#stateFilter').change(function() {
            oTable.fnFilter(this.value, 6);
        });
    });
    
    // Enable filtering on select
    /* Create an array with the values of all the select options in a column */
    // Link : http://www.datatables.net/examples/plug-ins/dom_sort.html
    $.fn.dataTableExt.afnSortData['dom-select'] = function  ( oSettings, iColumn )
    {
        var aData = [];
        $( 'td:eq('+iColumn+') select', oSettings.oApi._fnGetTrNodes(oSettings) ).each( function () {
            aData.push( $(this).val() );
        } );
        return aData;
    }
</script>
