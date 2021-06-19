<?php 
    session_start(); 
    include('connexion.php');
    $recupPlat=$cnx->prepare('SELECT nom_plat, prix_ttc, quantite
                            FROM commander 
                            NATURAL JOIN plat WHERE num_client=:id');
    $recupPlat->execute(array(':id'=>$_SESSION['id']));
    $livraison=$cnx->query('SELECT livraison FROM commander');
    foreach($livraison as $p){
        if($p['livraison']=='t'){
            $prix_total=5;
            $message=' (prix de la livraison (5€) compris)';
        }
        else{
            $prix_total=0;
            $message='';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de la commande</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h1> Voici la liste de votre commande : </h1>
    <table>
    <?php foreach($recupPlat as $recup): $quantite=$recup['quantite']; $prix=$quantite* $recup['prix_ttc']; $prix_total+=$prix?>
    <tr>
        <td><?php echo 'Plat commandé : '.$recup['nom_plat'].'</td>'.'<td>'.'|| quantite : '.$quantite.'</td>'.'<td>'.'|| prix TTC : '.$prix.'€';?>
        <?php endforeach ?>
    </tr>
    </table>
    <p>Prix total : <?php echo $prix_total.'€'.$message;?> </p>
    <form method="POST" action="terminé.php">
    <input type="submit" name="choix" value="Confirmer">
    <input type="submit" name="choix" value="Annuler">
    </form>
</body>
</html>
        
    

