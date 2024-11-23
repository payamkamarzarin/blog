<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';
require_once '../../functions/check-login.php';

if (isset($_GET['id']) && $_GET['id'] !== '') {
    global $pdo;
    $query = 'DELETE FROM categories WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
}
redirect('admin/category');
