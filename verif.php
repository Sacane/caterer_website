<?php

    /* Cette page vérifie si oui ou non le client à bien rentrer les bons identifiants */

    include('connexion.php'); //Connexion à la base de donnée

    $request=$cnx->query('SELECT * FROM client'); //Selection de la requete SQL principale

    /* Ici débute la vérification de l'appartenance de la saisi du client à la base de donnée (listes de nos connexions) */

    foreach($request as $test){  
        if (strcmp($test['prenom'], $_POST['prenom'])==0 && strcmp($test['nom_client'], $_POST['nom'])==0){     /* On compare ici la saisi et la base de donnée, si elles sont similaires on débute la session*/
            session_start();
            $_SESSION['nom']=$_POST['nom'];
            $_SESSION['prenom']=$_POST['prenom'];
            $_SESSION['id']=$test['num_client'];
            header('location: principale.php');
            exit;
        }
    }
    
    header('location: SeConnecter.php');
?>