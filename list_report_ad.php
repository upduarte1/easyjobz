<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/reports.php';
require_once 'includes/ads.php';
require_once 'includes/session.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$ad_id = intval($_GET['ad_id'] ?? 0);

if ($ad_id <= 0) {
    die("Invalid ad ID.");
}

$existing_report = getExistingAdReport($user_id, $ad_id, $pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel_report']) && $existing_report) {
        cancelReport($existing_report['id'], $pdo);
        header("Location: list_report_ad.php?ad_id=$ad_id&status=cancelled");
        exit();
    } elseif (isset($_POST['submit_report'])) {
        $reason = htmlspecialchars(trim($_POST['reason']));

        if (empty($reason)) {
            $error = "Please provide a reason for the report.";
        } else {
            $moderator_id = getAdModerator($ad_id, $pdo);
            submitAdReport($user_id, $ad_id, $reason, $moderator_id, $pdo);
            header("Location: list_report_ad.php?ad_id=$ad_id&status=submitted");
            exit();
        }
    }
}

$ad = getAdDetails2($ad_id, $pdo);
if (!$ad) {
    die("Ad not found.");
}

include_once 'templates/header.php';
include_once 'templates/list_report_ad_tpl.php';
include_once 'templates/footer.php';

?>
