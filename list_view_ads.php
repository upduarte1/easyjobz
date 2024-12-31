<?php

session_start();
require_once 'includes/db.php';
require_once 'includes/ads.php';
require_once 'includes/pagination.php';

$user_id = $_SESSION['user_id'];

$filters = [
    'user_id' => $user_id,
    'category' => htmlspecialchars($_GET['category'] ?? ''),
    'likes' => isset($_GET['likes']) && $_GET['likes'] === 'on',
    'sort_price' => htmlspecialchars($_GET['sort_price'] ?? ''),
    'sort_date' => htmlspecialchars($_GET['sort_date'] ?? ''),
    'limit' => 5,
    'offset' => (max(intval($_GET['page'] ?? 1), 1) - 1) * 5
];

try {
    $where_clause = buildWhereClause($filters);
    $ads = getAvailableAds($filters, $pdo);
    $total_pages = calculatePagination(
        $pdo,
        $where_clause,
        $filters['limit'],
        $user_id,
        $filters['category'] ?? null
    );
} catch (Exception $e) {
    die("Erro ao buscar anúncios disponíveis: " . $e->getMessage());
}

$current_page = max(1, intval($_GET['page'] ?? 1));
$base_url = 'list_browse_ads.php?' . http_build_query($_GET);

include_once 'templates/list_view_ads_tpl.php';

?>