<?php
/**
 * @var  $product_id ;
 */
require_once $__SERVER_ROOT . '/autoloader.php';
// Process user input
if (!isset($product_id)) {
    // redirect to main page
    header('Location:' . $__CLIENT_ROOT . '/home');
}

// Get product id
$id = intval($product_id);
$product = Product::find($id);

if (is_null($product)) {
    // redirect to main page
    header('Location:' . $__CLIENT_ROOT . '/home');
}

// Start session
session_start();
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Create the basket
$BASKET = new Basket($_SESSION['basket']);
if ($route[1] == 'add') {
    $BASKET->add($product);
    //                   1=add       2=id               3=darabszám                             4=string                                           5=total                                                                               6:az új ár
    print(" ;" . $route[1] . ";" . $product->getId() . ";" . $_SESSION['basket'][$product->getId()] . ";db van a kosárban a " . $product->getName() . " termékből;" . number_format($BASKET->getTotal(), 0, ',', ' ') . ";" . $product->getPrice() * $_SESSION['basket'][$product->getId()]);

} else if ($route[1] == 'minus') {
    if ($_SESSION['basket'][$product->getId()] == 1) {

        $BASKET->removeProduct($product->getId());
        //törölve lett minuszolással
        echo(" ;delete;" . $product->getId() . ";" . $product->getName() . " sikeresen törölve a kosárból;" . number_format($BASKET->getTotal(), 0, ',', ' '));

    } else {
        $BASKET->minus($product);
        //mezei minuszozás
        print(" ;minus;" . $product->getId() . ";" . $_SESSION['basket'][$product->getId()] . ";db van a kosárban a " . $product->getName() . " termékből;" . number_format($BASKET->getTotal(), 0, ',', ' ') . ";" . $product->getPrice() * $_SESSION['basket'][$product->getId()]);

    }
}else if ($route[1] = 'delete') {
    $BASKET->removeProduct($product->getId());
    //0=add                 1=id                2=string                                                    3=total ár
    echo(" ;" . $route[1] . ";" . $product->getId() . ";" . $product->getName() . " sikeresen törölve a kosárból;" . number_format($BASKET->getTotal(), 0, ',', ' '));
}

