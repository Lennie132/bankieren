<?php

if (isset($_POST['sign']) && $_POST['sign'] == true) {
    Transaction::sign($_POST['transaction'], $_POST['category']);
    unset($_POST['sign']);
    unset($_POST['transaction']);
    unset($_POST['category']);
}