<?php
session_start();
require_once $__SERVER_ROOT . '/autoloader.php';
$PAGE = 'product_edit';
$SUCCESS = false;
if (!isset($_SESSION['admin'])) {
    header('Location:' . $__CLIENT_ROOT . '/admin/authentication');
} else {
    /** @var string $action */
    $FORM = new ProductForm($_POST);
    if (!$FORM->isSubmitted() and $action == 'edit') {
        /** @var int $product_id */
        if ($product_id != null) {
            $FORM->findById($product_id);
        } else {
            //itt az van hogy szerkesztene, de nem l�tezik a term�k
        }
    } else if (!$FORM->isSubmitted() and $action == 'new') {
        $FORM->new();
    } else if (isset($_POST['delete']) and $action == 'delete') {

        /** @var TYPE_NAME $product_id */
            if(!$FORM->productInUse())
            $SUCCESS=$FORM->delete($product_id);
    } else
        if ($FORM->isSubmitted()) {
            $FORM->validate();
            if ($FORM->isValid()) {
                $SUCCESS = $FORM->save();
                echo 'saved:' . strval($SUCCESS);
            }
            else{
                echo 'non valid';
            }
        }
}
include($__SERVER_ROOT . '/views/admin_header.php');

if (!$SUCCESS and $action!='delete') {
    include($__SERVER_ROOT . '/views/admin_product_edit.php');
}else if(!$SUCCESS and $action='delete'){
    include($__SERVER_ROOT . '/views/admin_product_delete.php');
} else     header('Location:' . $__CLIENT_ROOT . '/admin/products');


include($__SERVER_ROOT . '/views/footer.php');

