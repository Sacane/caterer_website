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
            Voici la liste de nos Desserts !
        </h1>
    </header>
    <div class="d1">
        <?php 
        include('connexion.php');
        $request = $cnx->query("SELECT * FROM plat WHERE categorie = 'dessert'");
        if (!$request)
        {
            echo 'Erreur lors de l"affichage de vos entrées, la base de donnée est sans doute incomplète';
        }
        ?>
        <ul>
            <?php foreach($request as $dessert){?>
            <h1><?php echo $dessert['nom_plat'];?></h1>
            <p><?php echo 'Prix TTC : '.$dessert['prix_ttc'].'€';?></p>
            <img src="<?php echo $dessert['lienimg'];?>" width=300px/>
            <p><?php echo $dessert['description'];?></p>
            <?php } $cnx=null;?>
    </div>
    <?php include('footer.html');?>
</body>
</html>