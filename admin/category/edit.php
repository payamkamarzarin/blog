<?php
require_once '../../functions/helpers.php';
require_once '../../functions/connection.php';
require_once '../../functions/check-login.php';

global $pdo;

if (!isset($_GET['id'])) {
    redirect('admin/category');
}

$query = 'SELECT * FROM categories WHERE id = ?';
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);
$category = $stmt->fetch();
if ($category === false) {
    redirect('admin/category');
}
if (isset($_POST["name"]) && $_POST["name"] !== '') {
    /*
    $query = 'INSERT INTO categories (name) VALUES (:name)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':name', $_POST["name"]);
    $statement->execute();
    redirect('admin/category');
    */
    $query = 'UPDATE categories SET name = ?, updated_at = NOW() WHERE id = ?;';
    $Statement = $pdo->prepare($query);
    $Statement->execute([$_POST['name'], $_GET['id']]);
    redirect('admin/category');
}
?>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" media="all" type="text/css">
    <link rel="stylesheet" href="../../assets/css/style.css" media="all" type="text/css">
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

                <form action="<?= url('admin/category/edit.php?id=') . $_GET['id'] ?>" method="post">
                    <section class="form-group">
                        <label for="name">نام:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $category->name ?>">
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">ویرایش</button>
                    </section>

                </form>

            </section>
        </section>
    </section>

</section>

<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>

</html>