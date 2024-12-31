<?php

session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

include_once 'templates/header.php';
include_once 'templates/admin_dashboard_tpl.php';
include_once 'templates/footer.php';

?>