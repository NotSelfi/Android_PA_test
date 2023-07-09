<?php

require_once __DIR__."\\..\..\librairies\body.php";
require_once __DIR__."\\..\..\librairies\\res.php";
require_once __DIR__."\\..\..\\entities\\events\update_event.php";

$body = getBody();

$missing = [];

if (empty($body["id"])) $missing[] = "id";
if (empty($body["title"])) $missing[] = "title";
if (empty($body["description"])) $missing[] = "description";

if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    update_event($body["id"], $body["title"], $body["description"]);
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}

echo jsonRes(200, ["X-Server" => "lfl_pa"], [
    "success" => true,
    "message" => "event updated"
]);
