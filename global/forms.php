<?php

if (isset($_POST['sign']) && $_POST['sign'] == true) {
    Transaction::sign($_POST['transaction'], $_POST['category']);
    unset($_POST['sign']);
    unset($_POST['transaction']);
    unset($_POST['category']);
}

if (isset($_POST['save']) && $_POST['save'] == true) {
    //print_pre($_POST);
    preg_match("/\d+([\.|,]\d+)?/", $_POST['amount'], $preg_amount);
    preg_match("/\d+([\.|,]\d+)?/", $_POST['goal']['amount'], $preg_goal_amount);

    $amount = str_replace(',', '.', $preg_amount[0]);
    $goal_amount = str_replace(',', '.', $preg_goal_amount[0]);

    if ($_POST['category'] > 0) {
        $db = new Database();
        $db->query('UPDATE
                        `categories`
                    SET
                        `name` = :name,
                        `amount` = :amount,
                        `colour` = :colour,
                        `goal_description` = :goal_description,
                        `goal_amount` = :goal_amount,
                        `goal_date` = :goal_date
                    WHERE
                        `id` = :id;
                    ');
        $db->bind(':id', $_POST['category'], PDO::PARAM_INT);
        $db->bind(':name', $_POST['name'], PDO::PARAM_STR);
        $db->bind(':amount', $amount, PDO::PARAM_STR);
        $db->bind(':colour', $_POST['colour'], PDO::PARAM_STR);
        $db->bind(':goal_description', $_POST['goal']['description'], PDO::PARAM_STR);
        $db->bind(':goal_amount', $goal_amount, PDO::PARAM_STR);
        $db->bind(':goal_date', $_POST['goal']['date'], PDO::PARAM_STR);
        $db->execute();
    } else {
        $db = new Database();
        $db->query('INSERT INTO
                        `categories`
                        (`name`, `amount`, `colour`, `goal_description`, `goal_amount`, `goal_date`)
                    VALUES
                    (:name, :amount, :colour, :goal_description, :goal_amount, :goal_date)');
        $db->bind(':name', $_POST['name'], PDO::PARAM_STR);
        $db->bind(':amount', $amount, PDO::PARAM_STR);
        $db->bind(':colour', $_POST['colour'], PDO::PARAM_STR);
        $db->bind(':goal_description', $_POST['goal']['description'], PDO::PARAM_STR);
        $db->bind(':goal_amount', $goal_amount, PDO::PARAM_STR);
        $db->bind(':goal_date', $_POST['goal']['date'], PDO::PARAM_STR);
        $db->execute();
    }

    unset($_POST['save']);
    unset($_POST['category']);
    unset($_POST['amount']);
    unset($_POST['colour']);
    unset($_POST['goal']);
}

if (isset($_POST['add']) && $_POST['add'] == true) {
    //print_pre($_POST);
    preg_match("/\d+([\.|,]\d+)?/", $_POST['amount'], $preg_amount);
    $amount = str_replace(',', '.', $preg_amount[0]);

    $db = new Database();
    $db->query('INSERT INTO
                        `transactions`
                        (`store`, `amount`, `datetime`)
                    VALUES
                    (:store, :amount, :date)');
    $db->bind(':store', $_POST['store'], PDO::PARAM_STR);
    $db->bind(':amount', $amount, PDO::PARAM_STR);
    $db->bind(':date', $_POST['date'], PDO::PARAM_STR);
    $db->execute();

    unset($_POST['add']);
    unset($_POST['store']);
    unset($_POST['amount']);
    unset($_POST['date']);
}
