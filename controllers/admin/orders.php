<?php
session_start();
require_once $__SERVER_ROOT.'/autoloader.php';
if (!isset($_SESSION['admin'])) {
    header('Location:'.$__CLIENT_ROOT.'/admin/authentication');

}
else{
    $admin_orders=new Admin_Orders();
    $list_of_orders=$admin_orders->listOrders();

}
$PAGE='orders';
include($__SERVER_ROOT.'/views/admin_header.php');
include($__SERVER_ROOT.'/views/admin_orders.php');
include($__SERVER_ROOT.'/views/footer.php');

