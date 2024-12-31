<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/profile.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$user = getUserProfile($pdo, $user_id);
if (!$user) {
    die("User not found.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile_data = processProfileUpdate($user, $user_id);
    if ($profile_data['success']) {
        header("Location: list_profile.php?success=1");
        exit();
    } else {
        echo $profile_data['error'];
    }
}

include_once 'templates/header.php';
include_once 'templates/list_profile_tpl.php';
include_once 'templates/footer.php';

?>
