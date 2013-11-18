<?php
if (isset($global_username)) {
    echo 'Welcome back ' . $global_username . '!!!';
} elseif (Session::instance()->get('global_username') != '') {
    $global_username = Session::instance()->get_once('global_username');
    echo 'Welcome back ' . $global_username . '!!!<br/>';
};
?>

<?php echo HTML::anchor('login/register', 'Register!'); ?> <br/>
<?php echo HTML::anchor('login/login', 'Login'); ?> <br/>
<?php echo HTML::anchor('login/logout', 'Logout'); ?> <br/>
<?php echo HTML::anchor('supplier/findAll', 'Suppliers'); ?> <br/>
<?php echo HTML::anchor('productCategory/findAll', 'Product Categories'); ?> <br/>


