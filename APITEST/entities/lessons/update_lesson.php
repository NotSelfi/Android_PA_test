<?php

require_once __DIR__."/../../fonctions/functions.php";

function update_user(int $id, string $title, string $description) {
    try {
        $connectBdd = connectDB();
        $prepare = $connectBdd->prepare("UPDATE events SET title = :title, description = :description WHERE id = :id");
        $prepare->execute([
            ":title" => $title,
            ":description" => $description,
            ":id" => $id
        ]);
        echo "évènement mis à jour";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
