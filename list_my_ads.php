<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/ads.php';

$user_id = $_SESSION['user_id'];

try {
    $ads = getUserAnnouncements($user_id, $pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/list_my_ads_tpl.php';

?>