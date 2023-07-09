<?php

require_once __DIR__."\\..\..\librairies\body.php";
require_once __DIR__."\\..\..\librairies\\res.php";
require_once __DIR__."\\..\..\\entities\users\update_user.php";

$body = getBody();

$missing = [];

if (empty($body["id"])) $missing[] = "id";
if (empty($body["email"])) $missing[] = "email";
if (empty($body["adresse"])) $missing[] = "adresse";

if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    update_user($body["id"], $body["email"], $body["adresse"]);
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}

echo jsonRes(200, ["X-Server" => "lfl_pa"], [
    "success" => true,
    "message" => "user updated"
]);
