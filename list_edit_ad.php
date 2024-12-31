<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/ads.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$ad_id = intval($_GET['ad_id'] ?? 0);

if ($ad_id <= 0) {
    redirectWithError('list_browse_ads.php', 'Invalid ad ID.');
}

try {
    $ad = getAdDetails($ad_id, $user_id, $pdo);
    if (!$ad) {
        redirectWithError('list_browse_ads.php', 'Ad not found or unauthorized.');
    }
} catch (Exception $e) {
    redirectWithError('list_browse_ads.php', $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => htmlspecialchars($_POST['title']),
        'description' => htmlspecialchars($_POST['description']),
        'location' => htmlspecialchars($_POST['location']),
        'price' => floatval($_POST['price']),
        'category' => htmlspecialchars($_POST['category']),
        'date_to_be_done' => htmlspecialchars($_POST['date_to_be_done'])
    ];

    try {
        updateAd($ad_id, $user_id, $data, $pdo);
        header("Location: list_browse_ads.php?tab=my_ads");
        exit();
    } catch (Exception $e) {
        redirectWithError("list_edit_ad.php?ad_id=$ad_id", $e->getMessage());
    }
}

include_once 'templates/header.php';
include_once 'templates/list_edit_ad_tpl.php';
include_once 'templates/footer.php';

?>