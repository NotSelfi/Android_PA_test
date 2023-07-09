<?php

require_once __DIR__."/../../fonctions/functions.php";



function get_users(){
    try {
        $connectBdd = connectDB();
        $query = "SELECT * FROM users";
        $result = $connectBdd->query($query);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        
        
        header('Content-Type: application/json');
        echo json_encode($users);
        
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


get_users();
?>
