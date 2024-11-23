<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';
require_once '../../functions/check-login.php';

global $pdo;

if (isset($_GET['id']) and $_GET['id'] !== '')
{
    $query = 'SELECT * FROM posts WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
    $basePath = dirname(dirname(__DIR__));
    if (file_exists($basePath . $post->image)){
        unlink($basePath . $post->image);
    }
    global $pdo;
    $query = 'DELETE FROM posts WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
}
redirect('admin/post');