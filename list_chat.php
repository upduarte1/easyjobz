<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/services.php';
require_once 'includes/messages.php';
require_once 'includes/photos.php';

checkUserLoggedIn();

$user_id = $_SESSION['user_id'];
$service_id = intval($_GET['service_id'] ?? 0);

if ($service_id <= 0) {
    die("Invalid service.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = htmlspecialchars(trim($_POST['content']));
    $photo_path = null;

    try {
        if (isset($_FILES['photo'])) {
            $photo_path = handlePhotoUpload($_FILES['photo']);
        }
        sendMessage($service_id, $user_id, $content, $photo_path, $pdo);
        header("Location: list_chat.php?service_id=$service_id");
        exit();
    } catch (Exception $e) {
        die("Error sending message: " . $e->getMessage());
    }
}

try {
    $service = getServiceDetails($service_id, $user_id, $pdo);
    $messages = getServiceMessages($service_id, $pdo);
} catch (Exception $e) {
    die($e->getMessage());
}

include_once 'templates/header.php';
include_once 'templates/list_chat_tpl.php';
include_once 'templates/footer.php';

?>