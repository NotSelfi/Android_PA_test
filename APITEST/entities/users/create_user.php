<?php

require_once __DIR__."/../../fonctions/functions.php";

function create_user(string $username,string $prenom,string $mot_de_passe,string $email,string $adresse,string $ville,string $code_postal,string $telephone){
    try {
        $connectBdd = connectDB();
        

  $createUserQuery = $connectBdd->prepare("
    INSERT INTO users (
      username,
      prenom,
      mot_de_passe,
      email,
      adresse,
      ville,
      code_postal,
      telephone
    ) VALUES (
      :username,
      :prenom,
      :mot_de_passe,
      :email,
      :adresse,
      :ville,
      :code_postal,
      :telephone
    );
  ");

  return $createUserQuery->execute([
    ":username" => htmlspecialchars($username),
    ":prenom" => htmlspecialchars($prenom),
    ":mot_de_passe" => password_hash($mot_de_passe, PASSWORD_BCRYPT),
    ":email" => htmlspecialchars($email),
    ":adresse" => htmlspecialchars($adresse),
    ":ville" => htmlspecialchars($ville),
    ":code_postal" => htmlspecialchars($code_postal),
    ":telephone" => htmlspecialchars($telephone)
  ]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

