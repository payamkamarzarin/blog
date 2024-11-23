<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';
require_once '../../functions/check-login.php';

if (isset($_POST["title"]) && $_POST["title"] != '' &&
    isset($_POST["cate_id"]) && $_POST["cate_id"] != '' &&
    isset($_POST["body"]) && $_POST["body"] != '' &&
    isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    global $pdo;
    $query = 'SELECT * FROM categories WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['cate_id']]);
    $category = $stmt->fetch();

    $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMime = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    if (!in_array($imageMime, $allowedMimes)) {
        redirect('admin/post');
    }
    $basePath = dirname(dirname(__DIR__));
    $image = '/assets/images/posts/' . md5(rand()) . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $basePath . $image);

    if ($category !== false && $image_upload !== false) {
        $query = 'INSERT INTO posts SET title = ?, cate_id = ?, body = ?, image = ?, created_at = NOW() ;';
        $Statement = $pdo->prepare($query);
        $Statement->execute([$_POST['title'], $_POST['cate_id'], $_POST['body'], $image]);
    }
    redirect('admin/post');
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>create post</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">
    <?php require_once '../layouts/top-nav.php'; ?>
    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php require_once '../layouts/sidebar.php'; ?>
            </section>
            <section class="col-md-10 pt-3">

                <form action="<?= url('admin/post/create.php') ?>" method="POST" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="title">عنوان</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="title ...">
                    </section>
                    <section class="form-group">
                        <label for="image">عکس</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </section>
                    <section class="form-group">
                        <label for="cat_id">دسته بندی</label>
                        <select class="form-control" name="cate_id" id="cate_id">
                            <?php
                            global $pdo;
                            $query = "SELECT * FROM categories";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $categories = $stmt->fetchAll();
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php } ?>
                        </select>
                    </section>
                    <section class="form-group">
                        <label for="body">متن پست</label>
                        <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."></textarea>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">ایجاد پست</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>