<?php
$route = $_GET['route'] ?? 'home';
$route = explode('/', $route);
//var_dump($route);
?>

<?php

$__SERVER_ROOT = '..';
$__CLIENT_ROOT = '';
 if ($route[0] == 'home') {
    require_once('../controllers/index.php');
} else if ($route[0] == 'terms') {
    require_once('../controllers/terms.php');

} else if ($route[0] == 'order') {
    require_once('../controllers/order.php');

} else if ($route[0] == 'basket') {
    $product_id = $route[2] ?? null;
    if ($route[1] == 'add') {
        require_once('../controllers/basket.php');
    } else if ($route[1] == 'delete') {
        require_once('../controllers/basket.php');
    } else if ($route[1] == 'minus') {
        require_once('../controllers/basket.php');
    }
} else if ($route[0] == 'admin') {
    if (isset($route[1])) {
        if ($route[1] == 'authentication') {
            require_once('../controllers/admin/authentication.php');
        } else if ($route[1] == 'orders') {
            require_once('../controllers/admin/orders.php');
        } else if ($route[1] == 'products') {
            require_once('../controllers//admin/products.php');
        } else if ($route[1] == 'passchange') {
            require_once('../controllers//admin/passchange.php');
        } else if ($route[1] == 'product') {
            if ($route[2] == 'edit') {
                $action = $route[2];
                $product_id = $route[3] ?? null;
                require_once('../controllers/admin/product_edit.php');
            } else if ($route[2] == 'new') {
                $action = $route[2];
                require_once('../controllers/admin/product_edit.php');
            } else if ($route[2] == 'delete') {
                $product_id = $route[3] ?? null;

                $action = 'delete';
                require_once('../controllers/admin/product_edit.php');
            }
        }
    } else {
        require_once('../controllers/admin/orders.php');

    }

} else if ($route[0] == 'unsubscribe') {
    $token = $route[1] ?? null;
    require_once('../controllers/unsubscribe.php');
} else {
    require_once('../controllers/404.php');
}