<?php
include "global/general.php";

$categories = Category::get_all();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ondiep">
    <meta name="author" content="">
    <title>Reckoning</title>

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="dist/css/style.min.css" type="text/css">
</head>

<body>

<header>
    <div class="container">
        <div class="row">
            <div class="menu">
                <div class="col-xs-12">
                    <div class="menu__toggle"><img src="/bankieren/dist/img/icon-menu.png" alt=""></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="title">
                    <h1>My Categories</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="">
    <div>
        <?php if (!empty($categories)) { ?>
            <div class="row no-gutters categories">
                <?php foreach ($categories as $category) {  ?>
                    <div class="col-xs-6">
                        <div class="category">
                            <a class="category__link" href="">
                                <h3 class="category__name"><?= $category->getName(); ?></h3>
                                <span class="category__price"><?= $category->getGoalAmount(); ?></span>
                                <div class="category__colour"
                                     style="background-color: <?= $category->getColour() ?>"></div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>


</div><!-- Container close tag -->

<!-- JavaScript -->
<script src="dist/js/main.min.js"></script>

</body>
</html>