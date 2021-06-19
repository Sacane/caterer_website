<?php 
session_start();
include('connexion.php');
    if($_POST['choix']=='Annuler'){
        header('Location: choix.php');
        exit;
    }
    if($_POST['choix']=='Continuer'){  //SI il clique sur 'continuer' le plat sera rajouté à la table commander et le client pourra continuer sa commande
        if(!isset($_POST['plat'])){
            header('location: plat.php');
            exit;
        }
        $plat=$_POST['plat'];
        //Cette partie ne sert qu'à récupérer la valeur de l'id plat du plat séléctionner 
        $requete_id_plat=$cnx->prepare('SELECT id_plat FROM plat WHERE nom_plat=:plat');
        $requete_id_plat->execute(array(':plat'=>$plat));
        foreach($requete_id_plat as $id_plat){
            $id=$id_plat['id_plat']; //$id est l'id_plat du plat récupéré
        }
        //Fin de partie récupération de l'id_plat

        //Récupération du numéro de client
        $requete_num_client=$cnx->prepare('SELECT num_client FROM client WHERE prenom=:prenom');
        $requete_num_client->execute(array(':prenom'=>$_SESSION['prenom']));
        foreach($requete_num_client as $num_client){
            $numC=$num_client['num_client']; //$numC -> le num_client récupéré
            $_SESSION['id']=$numC;
        }
        //Fin de récupération du num_client
        
        //On test si la commande est déjà entré dans la base de donnée
        //Si c'est le cas on rajoute une nouvelle commande
        $ifexist=$cnx->prepare('SELECT * FROM commander WHERE id_plat=:id AND num_client=:num');
        $ifexist -> execute(array(':id'=>$id, 'num'=>$_SESSION['id']));
        $res=$ifexist->fetchAll();
        if(count($res)==0){
            $add=$cnx->prepare("INSERT INTO commander(num_client, id_plat, quantite, livraison, etat, date_livraison) 
            VALUES(:num_client, :idplat, 1, :livraison, 'En cours de preparation', NOW())");
            $add->execute(array(':num_client'=>$numC, ':idplat'=>$id, ':livraison'=>$_SESSION['livraison']));
        }else{ //Sinon on update la quantité
            $update=$cnx->prepare('UPDATE commander SET quantite=quantite+1 WHERE id_plat=:id AND num_client=:num');
            $update->execute(array(':id'=>$id, ':num'=>$_SESSION['id']));
        }
    
        header('location: choix.php'); 
    }

    if($_POST['choix']=='Valider'){ //Si le client clique sur 'valider, il sera redirigé vers la liste de ses commandes ainsi que le prix, il pourra valider pour payer.
        if(!isset($_POST['plat'])){
            header('location: choix.php');
            exit;
        }
        $plat=$_POST['plat'];
        $requete_id_plat=$cnx->prepare('SELECT id_plat FROM plat WHERE nom_plat=:plat');
        $requete_id_plat->execute(array(':plat'=>$plat));
        foreach($requete_id_plat as $id_plat){
            $id=$id_plat['id_plat']; 
        }
        //Fin de partie récupération de l'id_plat

        //Récupération du numéro de client
        $requete_num_client=$cnx->prepare('SELECT num_client FROM client WHERE prenom=:prenom');
        $requete_num_client->execute(array(':prenom'=>$_SESSION['prenom']));
        foreach($requete_num_client as $num_client){
            $numC=$num_client['num_client']; //$numC -> le num_client récupéré
        }
        //Fin de récupération du num_client

        $ifexist=$cnx->prepare('SELECT * FROM commander WHERE id_plat=:id');
        $ifexist -> execute(array(':id'=>$id));
        $res=$ifexist->fetchAll();
        if(count($res)==0){
            $add=$cnx->prepare("INSERT INTO commander(num_client, id_plat, quantite, livraison, etat, date_livraison) VALUES(:num_client, :idplat, 1, :livraison, 'En cours de preparation', NOW())");
            $add->execute(array(':num_client'=>$numC, ':idplat'=>$id, ':livraison'=>$_SESSION['livraison']));
        }else{
            $update=$cnx->prepare('UPDATE commander SET quantite=quantite+1 WHERE id_plat=:id');
            $update->execute(array(':id'=>$id));
        }
    
        header('location: confirmer.php'); 
        //fin du test et de l'ajout
    }
    if($_POST['choix']=='Abandonner'){
        $requete_num_client=$cnx->prepare('SELECT num_client FROM client WHERE prenom=:prenom');
        $requete_num_client->execute(array(':prenom'=>$_SESSION['prenom']));
        foreach($requete_num_client as $num_client){
            $numC=$num_client['num_client']; 
        $delete=$cnx->prepare('DELETE FROM commander WHERE num_client=:id');
        $delete->execute(array(':id'=>$numC));
        session_unset($_SESSION['livraison']);
        header('location: principale.php');
        }
    }
    $cnx=null;

    

