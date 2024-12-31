<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/admin.php';

checkAdminLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_id = intval($_POST['ad_id']);
    $status = htmlspecialchars($_POST['status']);

    try {
        updateAdStatus($ad_id, $status, $pdo);
        header("Location: admin_manage_ads.php?success=1");
        exit();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

try {
    $ads = getManageableAds($pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/header.php';
include_once 'templates/admin_manage_ads_tpl.php';
include_once 'templates/footer.php';

?>