<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/ads.php';
require_once 'includes/session.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];

$realized_ads = getRealizedAnnouncements($user_id, $pdo);
$received_ads = getReceivedAnnouncements($user_id, $pdo);

include_once 'templates/header.php';
include_once 'templates/list_history_tpl.php';
include_once 'templates/footer.php';

?>