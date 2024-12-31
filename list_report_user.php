<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/reports.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$reported_user_id = intval($_GET['user_id'] ?? 0);

if ($reported_user_id <= 0 || $reported_user_id === $user_id) {
    die("Invalid user ID.");
}

$existing_report = getExistingReport($user_id, $reported_user_id, $pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel_report']) && $existing_report) {
        cancelReport($existing_report['id'], $pdo);
        header("Location: list_report_user.php?user_id=$reported_user_id&status=cancelled");
        exit();
    } elseif (isset($_POST['submit_report'])) {
        $reason = htmlspecialchars(trim($_POST['reason']));

        if (empty($reason)) {
            $error = "Please provide a reason for the report.";
        } else {
            $report_id = submitUserReport($user_id, $reported_user_id, $reason, $pdo);
            assignModeratorToReport($report_id, $pdo); // Associa automaticamente um moderador
            header("Location: list_report_user.php?user_id=$reported_user_id&status=submitted");
            exit();
        }
    }
}

$reported_user = getUserDetails2($reported_user_id, $pdo);
if (!$reported_user) {
    die("User not found.");
}

include 'templates/header.php'; 
include 'templates/list_report_user_tpl.php';
include 'templates/footer.php';

?>