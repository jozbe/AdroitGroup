<?php
require_once $__SERVER_ROOT.'/autoloader.php';
session_start();
$SUCCESS=false;
$PAGE = 'passchange';
if (isset($_SESSION['admin']) AND $_SESSION['admin'] == true AND isset($_SESSION['user'])) {
    $admin = new Admin($_SESSION['user']);
    if (!empty($_POST)) {
        if($admin->isValid($_POST)){
            $SUCCESS=$admin->passchange($_POST['new1']);
        }
    }
} else {
    header('Location: ./authentication');
}
include($__SERVER_ROOT.'/views/admin_header.php');
include($__SERVER_ROOT.'/views/admin_passchange.php');
include($__SERVER_ROOT.'/views/footer.php');
?>



