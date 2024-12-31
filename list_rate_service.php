<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/rates.php';
require_once 'includes/session.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$service_id = intval($_GET['service_id'] ?? 0);

if ($service_id <= 0) {
    die("Invalid service ID.");
}

try {
    [$service, $column] = authorizeRating($service_id, $user_id, $pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rating = floatval($_POST['rating']);

        if ($rating < 0 || $rating > 5) {
            die("Invalid rating value. Rating must be between 0 and 5.");
        }

        saveRating($service_id, $column, $rating, $pdo);

        $person_id = ($column === 'contractor_rate') ? $service['contractor'] : $service['acceptor'];
        updatePersonGlobalRating($pdo, $person_id);

        header("Location: list_history.php?success=rating_submitted");
        exit();
    }
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/header.php';
include_once 'templates/list_rate_service_tpl.php';
include_once 'templates/footer.php';

?>