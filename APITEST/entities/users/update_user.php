<?php

require_once __DIR__."/../../fonctions/functions.php";

function update_users(int $id, string $email, string $adresse) {
    try {
        $connectBdd = connectDB();
        $prepare = $connectBdd->prepare("UPDATE users SET email = :email, adresse = :adresse WHERE id = :id");
        $prepare->execute([
            ":email" => $email,
            ":adresse" => $adresse,
            ":id" => $id
        ]);
        echo "user mis à jour";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
