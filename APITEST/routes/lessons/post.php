<?php

require_once __DIR__ . "\\..\..\librairies\body.php";
require_once __DIR__ . "\\..\..\librairies\\res.php";
require_once __DIR__ . "\\..\..\\entities\\events\create_event.php";

$body = getBody();

$missing = [];

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

if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    $result = create_event(
        $body["title"],
        $body["description"],
        $body["date"],
        $body["image"],
        $body["price"],
        $body["places"]
    );

    if ($result) {
        echo jsonRes(200, ["X-Server" => "lfl_pa"], [
            "success" => true,
            "message" => "Event created"
        ]);
    } else {
        echo jsonRes(500, ["X-Server" => "lfl_pa"], [
            "success" => false,
            "message" => "Failed to create event"
        ]);
    }
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}