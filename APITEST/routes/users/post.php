<?php

require_once __DIR__ . "\\..\..\librairies\body.php";
require_once __DIR__ . "\\..\..\librairies\\res.php";
require_once __DIR__ . "\\..\..\\entities\users\create_user.php";

$body = getBody();

$missing = [];

if (empty($body["username"])) {
    $missing[] = "username";
}
if (empty($body["prenom"])) {
    $missing[] = "prenom";
}
if (empty($body["mot_de_passe"])) {
    $missing[] = "mot_de_passe";
}
if (empty($body["email"])) {
    $missing[] = "email";
}
if (empty($body["adresse"])) {
    $missing[] = "adresse";
}
if (empty($body["ville"])) {
    $missing[] = "ville";
}
if (empty($body["code_postal"])) {
    $missing[] = "code_postal";
}
if (empty($body["telephone"])) {
    $missing[] = "telephone";
}

if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    $result = create_user(
        $body["username"],
        $body["prenom"],
        $body["mot_de_passe"],
        $body["email"],
        $body["adresse"],
        $body["ville"],
        $body["code_postal"],
        $body["telephone"]
    );

    if ($result) {
        echo jsonRes(200, ["X-Server" => "lfl_pa"], [
            "success" => true,
            "message" => "User created"
        ]);
    } else {
        echo jsonRes(500, ["X-Server" => "lfl_pa"], [
            "success" => false,
            "message" => "Failed to create user"
        ]);
    }
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}

