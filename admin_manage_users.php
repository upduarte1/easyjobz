<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/admin.php';

checkAdminLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $action = htmlspecialchars($_POST['action']);

    try {
        updateUserStatus($user_id, $action, $pdo);
        header("Location: admin_manage_users.php?success=1");
        exit();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

try {
    $users = getAllUsers($pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/header.php';
include_once 'templates/admin_manage_users_tpl.php';
include_once 'templates/footer.php';

?>