<?php
/**
 * @var $token
 */
require_once $__SERVER_ROOT.'/autoloader.php';
$PAGE = 'unsubscribe';

include '../views/header.php';      // This requres the $PAGE variable

    $subscribers= new Subscribers();
    $result=$subscribers->unsubscribe($token);
    include '../views/unsubscribe.php';

include '../views/footer.php';      // This has no variabldfse requirementsasd