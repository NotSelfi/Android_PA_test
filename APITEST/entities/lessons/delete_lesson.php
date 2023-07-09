<?php

require_once __DIR__."/../../fonctions/functions.php";

function delete_event(int $id) {
    try {
        $connectBdd = connectDB();
        $prepare = $connectBdd->prepare("DELETE FROM events WHERE id = :id");
        $prepare->execute([
            ":id" => $id
        ]);
        echo "eévènement supprimé";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
