<?php
/*
 *  <copyright file="orders.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>Andrew Assaly</author>
 *  <date>2014-01-19</date>
 *  <summary>The view that print all the orders of given restaurants.</summary>
 */
?>
<h2>
    <div class="left">Orders Placed</div>
    <div class="button">
        <?php echo HTML::anchor('order/getStep1/-1/findAll', '', array('class' => 'button_add', 'name' => 'Add')); ?>
    </div>
</h2>
<table id="orders">
    <thead>
        <tr>
            <th class="id">Id</th>
            <th>Restaurant</th>
            <th>Ordered Date</th>
            <th>Subtotal</th>
            <th>Shipping</th>
            <th>Taxes</th>
            <th>Total</th>
            <th>State</th>
            <th class="view">View</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
        <tr class="filter">
            <td><input class="search_init" type="text" value="Search id" name="search_id"></td>
            <td><input class="search_init" type="text" value="Search restaurant name" name="search_restaurant_name"></td>
            <td><input class="search_init" type="text" value="Search date created" name="search_date_created"></td>
            <td><input class="search_init" type="text" value="Search subtotal" name="search_subtotal"></td>
            <td><input class="search_init" type="text" value="Search shipping cost" name="search_shipping_cost"></td>
            <td><input class="search_init" type="text" value="Search taxes" name="search_taxes"></td>
            <td><input class="search_init" type="text" value="Search total cost" name="search_total_cost"></td>
            <td><input class="search_init" type="text" value="Search state" name="search_state_name"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="id">Id</th>
            <th>Restaurant</th>
            <th>Ordered Date</th>
            <th>Subtotal</th>
            <th>Shipping</th>
            <th>Taxes</th>
            <th>Total</th>
            <th>State</th>
            <th class="view">View</th>
            <th class="edit">Edit</th>
            <th class="remove">Remove</th>
        </tr>
    </tfoot>
    <tbody>
        <?php 
        foreach ($orders as $o) { ?>
            <tr>
                <td><?php echo $o->getOrderID(); ?></td>
                <td><?php echo $o->getRestaurantName(); ?></td>
                <td><?php echo $o->getDateCreated(); ?></td>
                <td><?php echo $o->getSubtotal(); ?></td>
                <td><?php echo $o->getShippingCost(); ?></td>
                <td><?php echo $o->getTaxes(); ?></td>
                <td><?php echo $o->getTotalCost(); ?></td>
                <td><?php echo $o->getStateName(); ?></td>
                <td><?php echo HTML::anchor('order/view/'.$o->getOrderID().'/findAll', '', array('class' => 'button_view', 'name' => 'View')); ?></td>
                <td><?php 
                    if ($o->getState() == Constants_OrderState::IN_PROGRESS) {
                        echo HTML::anchor('order/edit/'.$o->getOrderID().'/findAll', '', array('class' => 'button_edit', 'name' => 'Edit'));
                    } else {
                        echo HTML::anchor('order/editPO/'.$o->getOrderID().'/findAll', '', array('class' => 'button_edit', 'name' => 'Edit'));
                    }
                ?></td>    
                <td><?php 
                    if ($o->getState() == Constants_OrderState::IN_PROGRESS) {
                        echo HTML::anchor('order/delete/'.$o->getOrderID().'/findAll', '', array('class' => 'button_delete', 'name' => 'Delete'));
                    } else {
                        ?><span class="button_delete_disabled"></span><?php
                    }
                ?></td>
            </tr>
        <?php } ?>
        </tbody>
</table>
<script>
    var nbOfHiddenColumn = 1;
    
    $(document).ready(function() {
        var oTable = $('#orders').dataTable( {
                "bSortCellsTop": true,
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [8] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [9] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [10] }
                ]});
            
        $("thead tr.filter input").keyup( function () {
            oTable.fnFilter(this.value, $("thead tr.filter input").index(this) + nbOfHiddenColumn);
        });
    });
</script>