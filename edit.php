<?php
include "global/general.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . get_url_base());
}

$category = Category::get_single($_GET['id']);

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="dist/css/style.min.css" type="text/css">
</head>

<body>

<header>
    <div class="container">
        <div class="row">
            <div class="menu">
                <div class="col-xs-12">
                    <div class="menu__toggle">
                        <a href="<?= get_url_base(); ?>/single.php?id=<?= $category->getId(); ?>">
                            <i class="material-icons md-48 md-light">chevron_left</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="title title--colour">
                    <div class="title__colour" style="background-color: <?= $category->getColour(); ?>;"></div>
                    <h1><?= $category->getName(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div>
    <form action="" method="post">
        <input type="hidden" name="category" value="<?= $category->getId(); ?>">

        <label for="name">Naam</label>
        <input type="text" id="name" name="name" value="<?= $category->getName(); ?>">


        <h2>Doel</h2>
        <label for=""></label>
        <input type="text">

        <label for="goal[description]">Beschrijving</label>
        <textarea name="goal[description]" id="goal[description]" cols="30" rows="10"></textarea>

        <label for=""></label>
        <input type="range" id="goal['amount']">
        
        
    </form>

</div><!-- Container close tag -->

<!-- JavaScript -->
<script src="dist/js/main.min.js"></script>

</body>
</html>