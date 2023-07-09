<?php

require_once __DIR__."/../../fonctions/functions.php";

function create_event(string $title, string $description, string $date, string $image, float $price, int $places) {
    try {
        $connectBdd = connectDB();

        $createEventQuery = $connectBdd->prepare("
            INSERT INTO events (
                title,
                description,
                date,
                image,
                price,
                places
            ) VALUES (
                :title,
                :description,
                :date,
                :image,
                :price,
                :places
            );
        ");

        return $createEventQuery->execute([
            ":title" => htmlspecialchars($title),
            ":description" => htmlspecialchars($description),
            ":date" => htmlspecialchars($date),
            ":image" => htmlspecialchars($image),
            ":price" => $price,
            ":places" => $places
        ]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
