<?php

require_once __DIR__."/../../fonctions/functions.php";

function delete_users(int $id) {
    try {
        $connectBdd = connectDB();
        $prepare = $connectBdd->prepare("DELETE FROM users WHERE id = :id");
        $prepare->execute([
            ":id" => $id
        ]);
        echo "utilisateur supprimé";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
