<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';
require_once '../../functions/check-login.php';

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
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

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">پست ها</h2>
                    <a href="create.php" class="btn btn-sm btn-success">ایجاد پست</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>شماره شناسه</th>
                            <th>عکس</th>
                            <th>عنوان</th>
                            <th>شناسه دسته بندی</th>
                            <th>متن اصلی</th>
                            <th>وضعیت</th>
                            <th>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        global $pdo;
                        $query = "SELECT posts.*, categories.name AS category_name FROM POSTS LEFT JOIN categories ON posts.cate_id = categories.id";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $posts = $stmt->fetchAll();
                        foreach ($posts as $post) {
                        ?>
                        <tr>
                            <td><?php echo $post->id ?></td>
                            <td><img style="width: 90px;" src="<?php echo asset($post->image) ?>"></td>
                            <td><?php echo $post->title ?></td>
                            <td><?php echo $post->category_name ?></td>
                            <td><?php echo substr($post->body, 0,30) . "..." ?></td>
                            <td>
                                <?php if ($post->status == 1) { ?>
                                <span class="text-success">فعال</span>
                                <?php } else{ ?>
                                <span class="text-danger">غیرفعال</span></td>
                            <?php } ?>
                            <td>
                                <a href="<?= url('admin/post/change-status.php?id=') . $post->id ?>" class="btn btn-warning btn-sm">تغییر وضعیت</a>
                                <a href="<?= url('admin/post/edit.php?id=') . $post->id ?>" class="btn btn-info btn-sm">ویرایش</a>
                                <a href="<?= url('admin/post/delete.php?id=') . $post->id ?>" class="btn btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </section>


            </section>
        </section>
    </section>





</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>