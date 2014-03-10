<?php
/*
 *  <copyright file="restaurantOrders.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-24</date>
 *  <summary>The view that print all the orders of a restaurant.</summary>
 */
?>
<h2>
    <div class="left">Orders Placed</div>
    <div class="button">
        <?php echo HTML::anchor('order/getStep1/-1/getRestaurantOrders', '', array('class' => 'button_add', 'name' => 'Add')); ?>
    </div>
</h2>
<table id="orders">
    <thead>
        <tr>
            <th class="id">Id</th>
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
    </thead>
    <tfoot>
        <tr>
            <th><input class="search_init" type="text" value="Search id" name="search_id"></th>
            <th><input class="search_init" type="text" value="Search date created" name="search_date_created"></th>
            <th><input class="search_init" type="text" value="Search subtotal" name="search_subtotal"></th>
            <th><input class="search_init" type="text" value="Search shipping cost" name="search_shipping_cost"></th>
            <th><input class="search_init" type="text" value="Search taxes" name="search_taxes"></th>
            <th><input class="search_init" type="text" value="Search total cost" name="search_total_cost"></th>
            <th><input class="search_init" type="text" value="Search state" name="search_state_name"></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
        <?php 
        foreach ($orders as $o) { ?>
            <tr>
                <td><?php echo $o->getOrderID(); ?></td>
                <td><?php echo $o->getDateCreated(); ?></td>
                <td><?php echo $o->getSubtotal(); ?></td>
                <td><?php echo $o->getShippingCost(); ?></td>
                <td><?php echo $o->getTaxes(); ?></td>
                <td><?php echo $o->getTotalCost(); ?></td>
                <td><?php echo $o->getStateName(); ?></td>
                <td><?php echo HTML::anchor('order/view/'.$o->getOrderID().'/getRestaurantOrders', '', array('class' => 'button_view', 'name' => 'View')); ?></td>
                <td><?php 
                    if ($o->getState() == Constants_OrderState::IN_PROGRESS) {
                        echo HTML::anchor('order/edit/'.$o->getOrderID().'/getRestaurantOrders', '', array('class' => 'button_edit', 'name' => 'Edit'));
                    } else {
                        echo HTML::anchor('order/editPO/'.$o->getOrderID().'/getRestaurantOrders', '', array('class' => 'button_edit', 'name' => 'Edit'));
                    }
                ?></td> 
                <td><?php 
                    if ($o->getState() == Constants_OrderState::IN_PROGRESS) {
                        echo HTML::anchor('order/delete/'.$o->getOrderID().'/getRestaurantOrders', '', array('class' => 'button_delete', 'name' => 'Delete'));
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
                "bStateSave": true,
                "bAutoWidth": false,
                "aoColumnDefs": [
                    { "bSortable": false, "bSearchable": false, "bVisible": false, "aTargets": [0] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [7] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [8] },
                    { "bSortable": false, "bSearchable": false, "aTargets": [9] }
                ]});
            
        $("tfoot input").keyup( function () {
            oTable.fnFilter(this.value, $("tfoot input").index(this) + nbOfHiddenColumn);
        });
    });
</script>