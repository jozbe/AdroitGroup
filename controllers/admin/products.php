<?php
session_start();
require_once $__SERVER_ROOT.'/autoloader.php';
$PAGE='products';
if (!isset($_SESSION['admin'])) {
    header('Location:'.$__CLIENT_ROOT.'/admin/authentication');
}
$PROMO_PRODUCTS = new ProductList(true);
$OTHER_PRODUCTS = new ProductList(false);


include($__SERVER_ROOT.'/views/admin_header.php');
include($__SERVER_ROOT.'/views/admin_products.php');
include($__SERVER_ROOT.'/views/footer.php');

