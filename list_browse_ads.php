<?php

session_start();
require_once 'includes/session.php';

checkUserLoggedIn();

$current_tab = $_GET['tab'] ?? 'my_ads';

include_once 'templates/header.php';
include_once 'templates/list_browse_ads_tpl.php';
include_once 'templates/footer.php';

?>