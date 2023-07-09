<?php

require_once __DIR__."\\..\..\librairies\\res.php";
require_once __DIR__."\\..\..\\entities\\events\get_event.php";
require_once __DIR__."\\..\..\librairies\body.php";

//Get the request body content
$body = getBody();
$missing = [];

// Check for the required fields in the request body
if (empty($body["title"])) {
    $missing[] = "title";
}
if (empty($body["description"])) {
    $missing[] = "description";
}
if (empty($body["date"])) {
    $missing[] = "date";
}
if (empty($body["image"])) {
    $missing[] = "image";
}
if (empty($body["price"])) {
    $missing[] = "price";
}
if (empty($body["places"])) {
    $missing[] = "places";
}

// If required fields are missing, return a JSON response with the code 400
if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    $events = get_events();
    //Return a JSON response with code 200 containing the retrieved items
    echo jsonRes(200, ["X-Server" => "lfl_pa"], [
        "success" => true,
        "events" => $events
    ]);
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}

