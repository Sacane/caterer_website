<?php 
    include('connexion.php');
    $requete="SELECT nom_plat, prix_ttc, lienimg, description
    FROM plat
    WHERE id_plat in (
      SELECT R.plat1
      FROM (
        SELECT count(id_ingre) AS C1, id_plat AS plat1
        FROM ingredient NATURAL JOIN composer
        WHERE localite = 't'
        GROUP BY id_plat
          ) R,
          (
            SELECT count(id_ingre) AS C2, id_plat AS plat2
            FROM composer
            GROUP BY id_plat
          ) T
      WHERE R.C1 = T.C2 AND R.plat1 = T.plat2
    );"; 
    $local=$cnx->query($requete);
    
?>
    


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
            Voici la liste de nos plats locaux !
        </h1>
    </header>
    <div class="d1">
        <ul>
            <?php foreach($local as $localite){?>
            <h1><?php echo $localite['nom_plat'];?></h1>
            <p><?php echo 'Prix TTC : '.$localite['prix_ttc'].'€';?></p>
            <img src="<?php echo $localite['lienimg'];?>" width=300px/>
            <h3><?php echo $localite['description'];?></h3>
            <?php } $cnx=null;?>
    </div>
    <?php include('footer.html');?>
</body>
</html>