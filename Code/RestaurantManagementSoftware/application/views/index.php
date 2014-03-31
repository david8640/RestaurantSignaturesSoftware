<h2 align="center">Home Page</h2>

<h4>Quick Links</h4>
<div class="shortcut">
    <ul>
        <li>
            <a href="<?php echo URL::site('order/getStep1', array('id' => -1, 'lastAction' => 'findAll')); ?>">
                <?php echo HTML::image('application/style/images/new-order.png'); ?>
                <span>New Order</span>
            </a>
        </li>
        <li>
            <a href="<?php echo URL::site('order/findAll'); ?>">
                <?php echo HTML::image('application/style/images/view-orders.png'); ?>
                <span>View Orders</span>
            </a>
        </li>
        <li>
            <a href="<?php echo URL::site('inventory/findAll'); ?>">
                <?php echo HTML::image('application/style/images/inventory.png'); ?>
                <span>Inventory</span>
            </a>
        </li>
        <li>
            <a href="<?php echo URL::site('supplier/findAll'); ?>">
                <?php echo HTML::image('application/style/images/suppliers.png'); ?>
                <span>Supplier Info</span>
            </a>
        </li>
        <li>
            <a href="<?php echo URL::site('restaurantUser/findAll'); ?>">
                <?php echo HTML::image('application/style/images/user-access.png'); ?>
                <span>User Access</span>
            </a>
        </li>
    </ul>
</div>

