<?php 
    session_start();
    include('connexion.php');
    $requete_lab=$cnx->query('SELECT * FROM label');
    $requete_aller=$cnx->query('SELECT * FROM allergene');
?>

<html>
<head>
    <meta charset="utf-8">
    <title>choix</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h1>Vous pouvez précisez le contenu de vos plats</h1>
    <p> Selectionner les labels que vous voulez dans vos plats: 
        <form method="POST" action="plat.php">
       <?php while($label=$requete_lab->fetch()){?>
            <input type="checkbox" name="label[]" value=<?php echo $label['id_label'];?>><?php echo $label['nom_label'];?></label><br />
       <?php } ?>
         <p>Selectionner également les allergènes que vous ne voulez pas dans vos plats :</p>
        <?php while($allergene=$requete_aller->fetch()){?>
            <p><input type="checkbox" name="allergene[]" value=<?php echo $allergene['id_allergene'];?>><?php echo $allergene['nom_aller'];?></p>
         <?php } ?>
         </br>
        <input type="submit" name="submit" value="Passer au choix des plats"/> <br/>
        <br> <br>
        <?php include('footer.html'); $cnx=null;?>
        </form>
    </p>
</body>
</html>
