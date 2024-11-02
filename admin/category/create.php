<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" media="all" type="text/css">
    <link rel="stylesheet" href="../../assets/css/style.css" media="all" type="text/css">
</head>

<body>
<section id="app">

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
            </section>
            <section class="col-md-10 pt-3">

                <form action="create.php" method="post">
                    <section class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
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