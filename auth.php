<?php
    /* Verification du remplissage des valeurs */
    if(empty($_POST['nom']) || empty($_POST['prenom'])|| empty($_POST['adresse']) || empty($_POST['telephone']) || empty($_POST['CB'])|| empty($_POST['crypto'])){
        echo "ERREUR ! Vous n'avez pas rempli tout le formulaire ! ";
        echo "<a href=index.php>Cliquez ici pour revenir au formulaire d'authentification.</a>";
        exit;
    }


    include("connexion.php"); 
    $verif = $cnx->prepare('INSERT INTO client(nom_client, prenom, adresse, telephone, numCarte, num_crypto) VALUES(:nom, :prenom, :adresse, :telephone, :numcarte, :numcrypto)');
    $verif->execute(array(':nom'=>$_POST['nom'], ':prenom'=>$_POST['prenom'], ':adresse'=>$_POST['adresse'], ':telephone'=>$_POST['telephone'], ':numcarte'=>$_POST['CB'], ':numcrypto'=>$_POST['crypto']));
    if(!$verif)
    {
        echo "<h1>Erreur de saisie ! Impossible de vous rajouter dans notre base de donnée.</h1>";
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page d'accueil traiteur</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
<header>
    Vous vous êtes bien authentifié ! 
</header>
<a href="SeConnecter.php">Cliquez ici pour vous connecter !</a>
</body>
</html>
