<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/services.php';

$user_id = $_SESSION['user_id'];

try {
    $accepted_services = getAcceptedServices($user_id, $pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/list_accepted_services_tpl.php';

?>