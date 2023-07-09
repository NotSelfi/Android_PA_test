<?php

require_once __DIR__ . "\\..\..\librairies\param.php";
require_once __DIR__ . "\\..\..\librairies\res.php";
require_once __DIR__ . "\\..\..\fonctions\functions.php";
require_once __DIR__ . "\\..\..\entities\users\delete_user.php";


// Récupération du paramètre user" de la route
$user = getParametersForRoute("APITEST\users\:user")["user"];


try {
    // Appel de la fonction "delete_user" pour supprimer l'user correspondant
    delete_user(intval($user));
} catch (PDOException $exception) {
    echo jsonRes(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
    // Arrêter l'exécution du script après avoir renvoyé la réponse JSON
    die();
}

echo jsonRes(200, ["X-Server" => "lfl_pa"], [
    "success" => true,
    "message" => "user $user deleted"
]);
