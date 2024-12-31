<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/reports.php';

checkAdminLoggedIn();

$admin_id = $_SESSION['user_id'];

$pending_reports = getReportsByStatusAndModerator('pending', $admin_id, $pdo);
$reviewed_reports = getReportsByStatusAndModerator('reviewed', $admin_id, $pdo);
$dismissed_reports = getReportsByStatusAndModerator('dismissed', $admin_id, $pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_id = intval($_POST['report_id']);
    $action = $_POST['action'] ?? '';

    if (!in_array($action, ['reviewed', 'dismissed', 'pending'])) {
        die("Invalid action.");
    }

    updateReportStatus($report_id, $action, $pdo);

    header("Location: admin_notifications.php?success=1");
    exit();
}

include_once 'templates/header.php';
include_once 'templates/admin_notifications_tpl.php';
include_once 'templates/footer.php';

?>