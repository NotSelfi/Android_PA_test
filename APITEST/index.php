<?php

require_once __DIR__ . "/librairies/path.php";
require_once __DIR__ . "/librairies/method.php";


ini_set("display_errors", 1);
error_reporting(E_ALL);


$path = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];


if (isPath("APITEST/users")) {
    if (isGetMethod()) {
        
        require_once __DIR__ . "\\routes\users\get.php";
    } elseif (isPostMethod()) {
        require_once __DIR__ . "\\routes\users\post.php";
    }
} elseif (isPath("APITEST/users/:user")) {
    if (isDeleteMethod()) {
        require_once __DIR__ . "\\routes\users\delete.php";
        die();
    } elseif (isPatchMethod()) {
        require_once __DIR__ . "\\routes\users\patch.php";
        die();
    } elseif (isGetMethod()) {
        require_once __DIR__ . "\\routes\users\get.php";
    }
}

if (isPath("APITEST/events")) {
    if (isGetMethod()) {
        
        require_once __DIR__ . "\\routes\\events\get.php";
    } elseif (isPostMethod()) {
        require_once __DIR__ . "\\routes\\events\post.php";
    }
} elseif (isPath("APITEST/events/:event")) {
    if (isDeleteMethod()) {
        require_once __DIR__ . "\\routes\\events\delete.php";
        die();
    } elseif (isPatchMethod()) {
        require_once __DIR__ . "\\routes\\events\patch.php";
        die();
    } elseif (isGetMethod()) {
        require_once __DIR__ . "\\routes\\events\get.php";
    }
}
