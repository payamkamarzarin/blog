<?php
require_once 'functions/helpers.php';
require_once 'functions/connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">
    <?php require_once "layouts/top-nav.php" ?>
    <section class="container my-5">
        <?php
        $notFound = false;
        if (isset($_GET['id']) and $_GET['id'] !== '')
        {
        $query = 'SELECT * FROM categories WHERE id = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_GET['id']]);
        $category = $stmt->fetch();
        if($category !== false){

        ?>
        <section class="row">
            <section class="col-12">
                <h1><?= $category->name ?></h1>
                <hr>
            </section>
        </section>
        <section class="row">
            <?php
            $query = "SELECT * FROM posts WHERE status = 1 AND cate_id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_GET['id']]);
            $posts = $stmt->fetchAll();
            foreach ($posts as $post) {
                ?>
            <section class="col-md-4">
                <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid" src="" alt=""></section>
                <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                <p><?= substr($post->body, 0, 200) ?></p>
                <p><a class="btn btn-primary" href="<?= url('post-details.php?id=' . $post->id) ?>" role="button">View details »</a></p>
            </section>
            <?php
            }
            }else{
                $notFound = true;
            }
            }else{
                $notFound = true;
            }
            ?>
        </section>
        <?php
            if($notFound)
            {
        ?>
        <section class="row">
            <section class="col-12">
                <h1>Category not found</h1>
            </section>
        </section>
        <?php } ?>
    </section>
</section>

</section>
<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>