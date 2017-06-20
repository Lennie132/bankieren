<?php
include "global/general.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $category = new Category();
    $back_url = get_url_base();
} else {
    $category = Category::get_single($_GET['id']);
    $back_url = get_url_base() . "/single.php?id=" . $category->getId();
}

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
                        <a href="<?= $back_url; ?>">
                            <i class="material-icons md-48 md-light">chevron_left</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="title title--colour">
                    <?php if ($category->getName() != "") { ?>
                        <div class="title__colour" style="background-color: <?= $category->getColour(); ?>;"></div>
                        <h1><?=  $category->getName(); ?></h1>
                    <?php } else { ?>
                        <h1>Nieuwe Categorie</h1>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</header>

<div>
    <form action="" method="post">
        <input type="hidden" name="category" value="<?= $category->getId(); ?>">
        <div class="container">

            <h2>Algemeen</h2>
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="<?= $category->getName(); ?>" required>

            <label for="amount">Huidige balans</label>
            <input type="text" id="amount" name="amount" value="<?= $category->getAmount(); ?>" required pattern=".{3,}">

            <label for="colour">Kleur</label>
            <input type="color" id="colour" name="colour" value="<?= $category->getColour(); ?>" required>

            <h2>Doel</h2>
            <label for="goal[description]">Beschrijving</label>
            <textarea name="goal[description]" id="goal[description]" required><?= $category->getGoalDescription(); ?></textarea>

            <label for="goal[amount]">Bedrag</label>
            <input type="text" id="goal[amount]" name="goal[amount]" value="<?= $category->getGoalAmount(); ?>" required pattern=".{3,}">

            <label for="goal[date]">Behalen voor</label>
            <input type="date" id="goal[date]" name="goal[date]" value="<?= $category->getGoalDate(); ?>" required min="<?= date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")+1, date("Y"))); ?>">

            <button type="submit" name="save" value="true">Opslaan</button>
        </div>


    </form>

</div><!-- Container close tag -->

<!-- JavaScript -->
<script src="dist/js/main.min.js"></script>

</body>
</html>