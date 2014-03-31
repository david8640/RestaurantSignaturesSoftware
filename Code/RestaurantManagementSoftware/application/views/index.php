<h2>Home Page</h2>

<h4>Quick Links</h4>
<div class="shortcut">
    <ul>
        <li>
            <a href="<?php echo URL::site('order/getStep1', array('id' => -1, 'lastAction' => 'findAll')); ?>">
                <?php echo HTML::image('application/style/images/new_order.png'); ?>
                <span>New Order</span>
            </a>
        </li>
        <li>
            <a href="<?php echo URL::site('order/findAll'); ?>">
                <?php echo HTML::image('application/style/images/view_orders.png'); ?>
                <span>View Orders</span>
            </a>
        </li>
    </ul>
</div>

