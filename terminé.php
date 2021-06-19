<?php 
    session_start();
    include('connexion.php');
    if(isset($_POST['choix'])){
        if($_POST['choix']=='Annuler'){
            header('location: choix.php');
            exit;
        }
        if($_POST['choix']=='Confirmer'){
            session_unset($_SESSIOn['livraison']);
            $_SESSION['suivi']='disponible';
            header('location: principale.php');
        }
    }
?>