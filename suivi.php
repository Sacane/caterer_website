<?php 
    session_start();
    if(empty($_SESSION['id'])){
        echo "<h1>Vous n'avez encore rien commandé !</h1>";
    }
    include('connexion.php');
    $commande=$cnx->prepare('SELECT nom_plat, prix_ttc, quantite, etat FROM commander NATURAL JOIN plat WHERE num_client=:num');
    $commande->execute(array(':num'=>$_SESSION['id']));
?>
<DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>choix</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h2> Suivez en temps réels le résumé ainsi que l'avancement de votre commande :</h2>
    <h3>Lorsque l'etat de la commande sera 'prete', vous pourrez venir la chercher, ou alors le livreur arrivera chez vous si vous avez commandé à domicile</h3>
    
    <center>
    <table id='tableau'><table><thead><tr><th>Nom du plat</th><th>quantité</th><th>Prix</th></thead>
 
    <?php foreach($commande as $com){ $etat=$com['etat'];?>
    <tr><th><?php echo $com['nom_plat'];?></th><th><?php echo $com['quantite'];?></th><th><?php echo $com['prix_ttc'].'€';?></th>
    <?php } ?>
    </table>
    <?php if(!empty($etat)){ ?>
    <h3>Etat de la commande : <?php echo $etat;?></h3>
    <?php }else{?>
    <h4>Vous n'avez rien commandé</h4>
    <?php }?>
    </center>
    <br>
    <footer><a href='principale.php'>Retourner au menu</a></footer>
</body>
</html>