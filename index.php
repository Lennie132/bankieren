<?php
include "global/general.php";

$categories = Category::get_all();


$unsigned = Transaction::get_all_unsigned();

//print_pre($unsigned);

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

<?php
if (!empty($unsigned)) {
    $item = $unsigned[0];
    ?>
    <div class="unsigned">
        <div class="unsigned__inner">
            <div class="unsigned__count"><span><?= count($unsigned); ?> nieuwe transacties</span></div>
            <h3 class="unsigned__price"><?= $item->getAmount(); ?></h3>
            <h4 class="unsigned__store"><?= $item->getStore(); ?></h4>
            <div class="unsigned__categories">
                <form action="" method="post">
                    <input type="hidden" name="sign" value="true">
                    <input type="hidden" name="transaction" value="<?= $item->getId(); ?>">
                    <?php
                    if ($item->getCombination() != 0) {
                        $category = Category::get_single($item->getCombination());
                        ?>
                        <h5 class="unsigned__common">Voorgestelde categorie:</h5>
                        <div class="unsigned__category unsigned__category--single">
                            <button name="category" value="<?= $category->getId(); ?>">
                                <h3 class="category__name"><?= $category->getName(); ?></h3>
                                <span class="category__price"><?= $category->getAmount(); ?></span>
                                <div class="category__colour"
                                     style="background-color: <?= $category->getColour() ?>"></div>
                            </button>
                        </div>


                        <h6 class="unsigned__choose"><a href="">Kies andere categorie</a></h6>
                        <?php
                    } else {

                        ?>
                        <?php if (!empty($categories)) { ?>
                            <?php foreach ($categories as $category) { ?>
                                <div class="unsigned__category">
                                    <button name="category" value="<?= $category->getId(); ?>">
                                        <div class="category__colour"
                                             style="background-color: <?= $category->getColour() ?>"></div>
                                        <h3 class="category__name"><?= $category->getName(); ?></h3>
                                        <span class="category__price"><?= $category->getAmount(); ?></span>
                                    </button>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <?php

                    }

                    ?>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<header>
    <div class="container">
        <div class="row">
            <div class="menu">
                <div class="col-xs-12">
                    <div class="menu__toggle">
                        <i class="material-icons md-36">euro_symbol</i>
                        <span>Reckoning</span>
                    </div>
                    <div class="menu__edit_category">
                        <a href="<?= get_url_base(); ?>/edit.php">
                            <i class="material-icons md-36 md-light">add</i>
                        </a>
                    </div>
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
                <?php foreach ($categories as $category) { ?>
                    <div class="col-xs-6">
                        <div class="category">
                            <a class="category__link" href="single.php?id=<?= $category->getId(); ?>">
                                <h3 class="category__name"><?= $category->getName(); ?></h3>
                                <span class="category__price"><?= $category->getAmount(); ?></span>
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