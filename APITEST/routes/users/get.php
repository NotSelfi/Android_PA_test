<?php

require_once __DIR__."\\..\..\librairies\\res.php";
require_once __DIR__."\\..\..\\entities\users\get_user.php";
require_once __DIR__."\\..\..\librairies\body.php";

//Get the request body content
$body = getBody();
$missing = [];

// Check for the required fields in the request body
if (empty($body["id"])) {
    $missing[] = "id";
}

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

// If required fields are missing, return a JSON response with the code 400
if (!empty($missing)) {
    echo jsonRes(400, ["X-Server" => "lfl_pa"], [
        "message" => "Missing field" . (count($missing) > 1 ? "s" : "") . ": " . implode(", ", $missing)
    ]);
    die();
}

try {
    $users = get_users();
    //Return a JSON response with code 200 containing the retrieved items
    echo jsonRes(200, ["X-Server" => "lfl_pa"], [
        "success" => true,
        "users" => $users
    ]);
} catch (PDOException $exception) {
    echo jsonRes(500, ["X-Server" => "lfl_pa"], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    die();
}

