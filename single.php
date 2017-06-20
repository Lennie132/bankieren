<?php
include "global/general.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . get_url_base());
}

$category = Category::get_single($_GET['id']);

$advice = "";
$now = new DateTime();
$goal_date = new DateTime($category->getGoalDate());
$date_diff = $now->diff($goal_date);
$amount_diff = $category->getAmountRaw() - $category->getGoalAmountRaw();
$perc_diff = round(($category->getAmountRaw() - $category->getGoalAmountRaw()) / (($category->getAmountRaw() + $category->getGoalAmountRaw()) / 2) * 100, 1);
if ($amount_diff < 0) {
    $amount_diff *= -1;
    $advice = "is in gevaar.<br><br>Je hebt nog {$date_diff->days} dagen om € {$amount_diff} te sparen! Spaar meer geld.";
} else if ($perc_diff < 10) {
    $advice = "is haalbaar.<br><br>Over $date_diff->days dagen wil je je doel behalen. Pas op want je hebt maar {$perc_diff}% meer dan je doel bedrag. Geef niet overbodig geld uit!";
} else if ($perc_diff < 40) {
    $advice = "is bijna binnen!<br><br>Over $date_diff->days dagen wil je je doel behalen en je hebt {$perc_diff}% meer dan je doel bedrag.";
} else if ($perc_diff >= 40) {
    $advice = "is harstikke veilig!<br><br>Over $date_diff->days dagen wil je je doel behalen en je hebt  wel {$perc_diff}% meer dan je doel bedrag. Je bent goed bezig!";
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

<?php if (!isset($_GET['done'])) { ?>
    <div class="advice">
        <div class="advice__inner">
            <div class="advice__header"><span>Doel status</span></div>
            <div class="advice__body">
                <h3 class="advice__title"><?= $category->getName(); ?></h3>
                <span class="advice__intro">Jouw doel</span>
                <q class="advice__text"><?= $category->getGoalDescription(); ?></q>
                <span class="advice__outro"><?= $advice; ?></span>
                <div class="advice__categories">
                </div>
            </div>
            <div class="advice__footer"><a href="<?= get_url_current(); ?>&done=true">Ok</a></div>
        </div>
    </div>
<?php } ?>

<header>
    <div class="container">
        <div class="row">
            <div class="menu">
                <div class="col-xs-12">
                    <div class="menu__toggle">
                        <a href="<?= get_url_base(); ?>">
                            <i class="material-icons md-48 md-light">chevron_left</i>
                        </a>
                    </div>
                    <div class="menu__edit_category">
                        <a href="<?= get_url_base(); ?>/edit.php?id=<?= $category->getId(); ?>">
                            <i class="material-icons md-36 md-light">edit</i>
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
<div class="current">
    <div class="current__balance">
        <?= $category->getAmount(); ?>
    </div>
</div>

<div>
    <?php if (!empty($category->getTransactions())) { ?>
        <div class="transactions transactions--list">
            <?php foreach ($category->getTransactions() as $transaction) { ?>
                <div class="transaction">
                    <small class="transaction__date"><?= $transaction->getDate()->format('m/d H:i'); ?></small>
                    <h4 class="transaction__store"><?= $transaction->getStore(); ?></h4>
                    <span class="transaction__amount"><?= $transaction->getAmount(); ?></span>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="text-center">Geen transacties</div>
    <?php } ?>

</div><!-- Container close tag -->

<!-- JavaScript -->
<script src="dist/js/main.min.js"></script>

</body>
</html>