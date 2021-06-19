<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page d'accueil traiteur</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <header>
        <h1 id="head">
            Voici la liste de nos entrées !
        </h1>
    </header>
    <div class="d1">
        <?php
        include('connexion.php');
        $request = $cnx->query("SELECT * FROM plat WHERE categorie='entree'");
        if (!$request)
        {
            echo 'Erreur lors de l"affichage de vos entrées, la base de donnée est sans doute incomplète';
        }
        ?>
        <ul>
        <?php foreach($request as $entree){ ?>
            <h1><?php echo $entree['nom_plat'];?></h1>
            <p><?php echo 'Prix TTC : '.$entree['prix_ttc'].'€';?></p>
            <img src = "<?php echo $entree['lienimg'];?>" width=300px/>
            <p><?php echo $entree['description'];?></p>
        <?php } $cnx=null; ?>
        <?php include('footer.html');?>
    </div>
</body>
</html>

