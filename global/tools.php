<?php

function print_pre($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function get_url_base() {
    $url = sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );
    if ($url == "http://localhost") {
        $url .= "/bankieren";
    } else if ($url == "https://stud.hosted.hr.nl") {
        $url .= "/0893738/bankieren";
    }
    return $url;
}

function get_url_current() {
    $url = sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
    if ($url == "http://localhost") {
        $url .= "/bankieren";
    } else if ($url == "https://stud.hosted.hr.nl") {
        $url .= "/0893738/bankieren";
    }
    return $url;
}