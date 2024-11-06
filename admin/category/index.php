<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';

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
                    <h2 class="h4">دسته بندی ها</h2>
                    <a href="<?= url('admin/category/create.php') ?>" class="btn btn-sm btn-success">ایجاد دسته بندی</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>وضعیت</th>
                            <th>تاریخ ساخت دسته بندی</th>
                            <th>تاریخ آپدیت دسته بندی</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            global $pdo;
                            $query = "SELECT * FROM categories";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $categories = $stmt->fetchAll();
                            foreach ($categories as $category) {
                        ?>
                        <tr>
                            <td><?php echo $category->id ?></td>
                            <td><?php echo $category->name ?></td>
                            <td><?php echo $category->status ?></td>
                            <td><?php echo $category->created_at ?></td>
                            <td><?php echo $category->updated_at ?></td>
                            <td><a href="<?= url('admin/category/edit.php?id=') . $category->id ?>" class="btn btn-info btn-sm">ویرایش</a></td>
                            <td><a href="<?= url('admin/category/delete.php?id=') . $category->id ?>" class="btn btn-danger btn-sm">حذف</a></td>
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