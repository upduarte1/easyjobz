<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/services.php';

$user_id = $_SESSION['user_id'];

try {
    $completed_services = getCompletedServices($user_id, $pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/list_completed_services_tpl.php';

?>