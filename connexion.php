<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user ="postgres"; 
$pass ="01012000"; 
try {
    $cnx = new PDO("pgsql:host=localhost;dbname=postgres", $user, $pass);  
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée";
}
?>
