<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/profile.php';
require_once 'includes/session.php';

checkUserLoggedIn();
$user_id = $_SESSION['user_id'];
$viewed_user_id = getValidatedUserId($_GET['user_id'] ?? 0);
$user = getUserProfile($pdo, $viewed_user_id);

include_once 'templates/header.php';
include_once 'templates/list_view_profile_tpl.php';
include_once 'templates/footer.php';

?>