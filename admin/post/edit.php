<?php
    require_once '../../functions/helpers.php';
    require_once '../../functions/connection.php';

    global $pdo;

    if (!isset($_GET['id']))
    {
        redirect('admin/post');
    }

    $query = 'SELECT * FROM posts WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
    if ($post === false)
    {
        redirect('admin/post');
    }

    if(
        isset($_POST["title"]) && $_POST["title"] != '' &&
        isset($_POST["cate_id"]) && $_POST["cate_id"] != '' &&
        isset($_POST["body"]) && $_POST["body"] != '')
    {


    $query = 'SELECT * FROM categories WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['cate_id']]);
    $category = $stmt->fetch();

    if (isset($_FILES['image']) && $_FILES['image']['name'] !== '')
    {
        $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
        $imageMime = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        if (!in_array($imageMime, $allowedMimes))
        {
            redirect('admin/post');
        }
        $basePath = dirname(dirname(__DIR__));
        if (file_exists($basePath . $post->image))
        {
            unlink($basePath . $post->image);
        }
        $image = '/assets/images/posts/' . md5(rand()) . '.' . $imageMime;
        $image_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $basePath . $image);

        if ($category !== false && $image_upload !== false)
        {
            $query = 'UPDATE posts SET title = ?, cate_id = ?, body = ?, image = ?, updated_at = NOW() WHERE id = ? ;';
            $Statement = $pdo->prepare($query);
            $Statement->execute([$_POST['title'], $_POST['cate_id'], $_POST['body'], $image, $_GET['id']]);
        }

    }
        else {
            if ($category !== false)
            {
                $query = 'UPDATE posts SET title = ?, cate_id = ?, body = ?, updated_at = NOW() WHERE id = ? ;';
                $Statement = $pdo->prepare($query);
                $Statement->execute([$_POST['title'], $_POST['cate_id'], $_POST['body'], $_GET['id']]);
            }
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

                <form action="<?= url('admin/post/edit.php?id=' . $_GET['id']) ?>" method="post" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="title">عنوان</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?= $post->title ?>"/>
                    </section>
                    <section class="form-group">
                        <label for="image">عکس</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <img src="<?= asset($post->image) ?>" alt="" class="mt-2" width="200" height="200">
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
                                <option value="<?= $category->id ?>" <?php if ($category->id == $post->cate_id) echo 'selected'; ?>> <?= $category->name ?> </option>
                            <?php } ?>
                        </select>
                    </section>
                    <section class="form-group">
                        <label for="body">متن پست</label>
                        <textarea class="form-control" name="body" id="body" rows="5"><?= $post->body ?></textarea>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">ویرایش</button>
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