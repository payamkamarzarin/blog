<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';

global $pdo;

if (isset($_GET['id']) and $_GET['id'] !== '')
{
    $query = 'SELECT * FROM posts WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
    if ($post !== false)
    {
        $status = ($post->status == 1) ? 0 : 1;
        $query = 'UPDATE posts SET status = ?, updated_at = NOW() WHERE id = ? ;';
        $Statement = $pdo->prepare($query);
        $Statement->execute([$status, $_GET['id']]);
    }
}
redirect('admin/post');