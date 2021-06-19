<?php 
    session_start();
    include('connexion.php');
    $id=$_POST['id'];
    $pass=$_POST['password'];
    $verif=$cnx->query('SELECT nom_traiteur, prenom_traiteur FROM traiteur');
    foreach($verif as $ver){
        $nom=$ver['nom_traiteur'];
        $prenom=$ver['prenom_traiteur'];
    }
    if(strcmp($prenom, $id)==0 && strcmp($nom, $pass)){
        $_SESSION['nom']='Administrateur';
        $_SESSION['admin']='open';
        header('location: principale.php');
        exit;
    } else{
        header('location: auth_membre.php');
    }