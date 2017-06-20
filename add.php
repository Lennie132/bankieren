<?php
include "global/general.php";

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
                        <a href="<?= get_url_base(); ?>">
                            <i class="material-icons md-48 md-light">chevron_left</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="title title--colour">
                    <h1>Nieuwe Transactie</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div>
    <form action="" method="post">
        <div class="container">

            <h2>Algemeen</h2>
            <label for="store">Winkel</label>
            <input type="text" id="store" name="store" value="" required>

            <label for="amount">Bedrag</label>
            <input type="text" id="amount" name="amount" value="€ " required
                   pattern=".{3,}">


            <label for="date">Datum</label>
            <input type="datetime" id="date" name="date" value="<?= date("Y-m-d H:i:s"); ?>" required
                   min="">

            <button type="submit" name="add" value="true">Voeg toe</button>
        </div>


    </form>

</div><!-- Container close tag -->

<!-- JavaScript -->
<script src="dist/js/main.min.js"></script>

</body>
</html>