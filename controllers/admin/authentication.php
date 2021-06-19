<?php
session_start();
require_once $__SERVER_ROOT.'/autoloader.php';
$SUCCESS=false;
if (!isset($_SESSION['admin'])) {
    if (isset($_POST['user']) && isset($_POST['pw'])) {
        $admin = new Admin($_POST['user']);
        $SUCCESS=$admin->auth($_POST['pw']);
        if ($SUCCESS) {
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $_POST['user'];
        }
    }
} else{
    $SUCCESS=true;

}
$PAGE='authentication';

    include($__SERVER_ROOT.'/views/admin_header.php');
    include($__SERVER_ROOT.'/views/admin_login.php');
    include($__SERVER_ROOT.'/views/footer.php');
