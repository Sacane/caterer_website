<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des plats</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <header>
        <h1 id="head">
            Voici la liste de nos plats principaux !
        </h1>
    </header>
    <div class="d1">
        <?php 
        include('connexion.php');
        $request = $cnx->query("SELECT * FROM plat WHERE categorie = 'plat principale'");
        if (!$request)
        {
            echo 'Erreur lors de l"affichage de vos entrées, la base de donnée est sans doute incomplète';
        }
        ?>
        <ul>
            <?php foreach($request as $plat){?>
            <h1><?php echo $plat['nom_plat'];?></h1>
            <img src="<?php echo $plat['lienimg'];?>" width=300px/>
            <p><?php echo 'Prix TTC : '.$plat['prix_ttc'].'€';?></p>
            <p><?php echo $plat['description'];?></p>
            <?php } $cnx=null;?>
    </div>
    <?php include('footer.html');?>
</body>
</html>
