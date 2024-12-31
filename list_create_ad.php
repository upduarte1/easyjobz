<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/ads.php';

checkUserLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => htmlspecialchars($_POST['title']),
        'description' => htmlspecialchars($_POST['description']),
        'location' => htmlspecialchars($_POST['location']),
        'price' => floatval($_POST['price']),
        'category' => htmlspecialchars($_POST['category']),
        'date_to_be_done' => htmlspecialchars($_POST['date_to_be_done']),
        'publisher_id' => $_SESSION['user_id'],
        'date_published' => date('Y-m-d')
    ];

    try {
        createAd($data, $pdo);
        header("Location: list_browse_ads.php?tab=my_ads");
        exit();
    } catch (Exception $e) {
        redirectWithError('list_create_ad.php', $e->getMessage());
    }
}

include_once 'templates/header.php';
include_once 'templates/list_create_ad_tpl.php';
include_once 'templates/footer.php';

?>