<?php

require_once __DIR__ . "\\..\..\librairies\param.php";
require_once __DIR__ . "\\..\..\librairies\\res.php";
require_once __DIR__ . "\\..\..\fonctions\\functions.php";
require_once __DIR__ . "\\..\..\entities\\events\delete_event.php";


// Récupération du paramètre event" de la route
$event = getParametersForRoute("APITEST\events\:event")["event"];


try {
    // Appel de la fonction "delete_event" pour supprimer l'event correspondant
    delete_event(intval($event));
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
    "message" => "event $event deleted"
]);
