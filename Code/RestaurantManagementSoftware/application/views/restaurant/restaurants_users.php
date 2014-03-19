<?php
/*
 *  <copyright file="restaurants_users.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2014-01-13</date>
 *  <summary>The view that print all the restaurants users.</summary>
 */
?>
<h2>Users Access Management</h2>
<?php
if (count($usersRights) > 0 && count($restaurants) > 0 && count($users) > 0) { 
    echo Form::open('restaurantUser/save');
    ?><table id="userRights">
        <thead>
            <tr>
                <th>Users/Restaurants</th><?php
                $count = 0;
                foreach ($restaurants as $r) {
                    ?><th><?php echo $r->getName(); ?><input type="checkbox" id="<?php echo $count; ?>" class="checkAll"/></th><?php 
                    $count++;
                }?>
            </tr>
        </thead>
        <tbody><?php
            foreach ($users as $u) { 
            ?><tr>
                <td><?php echo $u->getName(); ?></td><?php
                $count = 0;
                foreach ($restaurants as $r) {
                    $isCheck = 0;
                    if (isset($usersRights[$u->getId()][$r->getId()])) {
                        $isCheck = $usersRights[$u->getId()][$r->getId()];
                    }
                    ?><td><?php
                    echo Form::checkbox('is_check['.$u->getId().']['.$r->getId().']', 'is_check['.$u->getId().']['.$r->getId().']', $isCheck == 1, array('class' => 'checkbox_'.$count));
                    ?></td><?php
                    $count++;
                }
            ?></tr><?php
            } 
        ?>
        </tbody>
    </table>
    <span class="rightSaveBt">
        <?php  echo Form::submit(NULL, 'Save'); ?>
    </span><?php
    echo Form::close();
} else {
    ?><div><?php echo 'There is no users or restaurants' ?></div><?php
}
?>
<script>
    var nbOfHiddenColumn = 1;
    
    $(document).ready(function() {
        var oTable = $('#userRights').dataTable( {
            "bFilter": false,
            "bPaginate": false,
            "bSearchable": false,
            "bAutoWidth": false,
            "bInfo": false,
            "aoColumns": [
                    null,
                    { "sSortDataType": "dom-checkbox" },
                    { "sSortDataType": "dom-checkbox" }
		]
        });
            
        // Enable filtering on check box
        /* Create an array with the values of all the checkboxes in a column */
        $.fn.dataTableExt.afnSortData['dom-checkbox'] = function  ( oSettings, iColumn )
        {
            return $.map( oSettings.oApi._fnGetTrNodes(oSettings), function (tr, i) {
                    return $('td:eq('+iColumn+') input', tr).prop('checked') ? '1' : '0';
            } );
        }
        
        $(".checkAll").change(function () { 
            var id = $(this).attr('id');
            $('.checkbox_'+id).prop('checked', this.checked);
        });
    });
</script>