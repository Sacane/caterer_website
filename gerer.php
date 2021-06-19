<?php 
    session_start();
    include('connexion.php');
    $num_cli=array();
    $commande=$cnx->prepare('SELECT nom_client, nom_plat, prix_ttc, quantite, etat, num_client FROM commander NATURAL JOIN plat NATURAL JOIN client WHERE num_client=:num');
    $liste_client=$cnx->query('SELECT num_client FROM client');
    
    foreach($liste_client as $client){
        $num_cli[$client['num_client']]=$client['num_client'];
    }
?>
<DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>administrateur</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h2> Suivez en temps réels le résumé ainsi que l'avancement de votre commande :</h2>
    <center>
    <form method='POST' action=''>
    <table id='tableau'><table><thead><tr><th>Nom du client </th><th>Nom du plat </th><th>quantité </th><th>Prix </th></thead>
    <?php foreach($num_cli as $key=>$value){ $commande->execute(array(':num'=>$key));  foreach($commande as $com){ $etat=$com['etat'];?>
    <tr><th><?php echo $com['nom_client'] ?></th><th><?php echo $com['nom_plat'];?></th><th><?php echo $com['quantite'];?></th><th><?php echo $com['prix_ttc'].'€';?></th>
        <th><label for="gerer">Rendre disponible la commande : </label><input type='submit' name='gerer' value=<?php echo $com['num_client']?>></th>
        <th><label for="end">Teminé la commande</label><input type='submit' name='end' value=<?php echo $com['num_client']?>></th>
    <?php } ?>
    
        
    
    
    <?php } ?>
    </table>
    </form>
    </center>
    <br>
    <footer><a href='principale.php'>Retourner au menu</a></footer>
</body>
</html>

<?php 
    if(isset($_POST['gerer'])){
        $change=$cnx->prepare("UPDATE commander SET etat ='commande prete' WHERE num_client=:num");
        $change->execute(array(':num'=>$_POST['gerer']));
    }
    if(isset($_POST['end'])){
        $delete=$cnx->query("DELETE FROM commander");
    }
    $cnx=null;
?>
