<?php session_start(); ?>
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
            Bienvenue sur notre site internet ! 
        </h1>
        <?php include('header.php');?>
    </header>
    <div class="d1">
    <nav>  <!-- Initialisation du menu -->
        <ul>
            <p id="p1">
                <?php if(!empty($_SESSION['admin'])){?>
                <a class='"l' href="gerer.php">Gerer les commandes<?php }?></a> &nbsp
                <a class="l" href="suivi.php">Suivi de la commande</a> &nbsp
                <a class="l" href="livraison.php">Commander</a> &nbsp
                <?php if(!empty($_SESSION)){?> <a class="l" href="Deconnexion.php">Deconnexion</a><?php } ?>
                </p>
        </ul>
    </nav>
    </div>
    <nav>       <!-- Initialisation de la liste des plats-->
        <ul>
        <center>
            <div class="d2">
                <a href="ListeDesEntrees.php" ><img class="i1" src="entrees.jpg" width ="200" height="130" alt="My entrees"></a>
                <a class ="l1" href="ListeDesEntrees.php">Liste des entrées</a>&nbsp
            </div>
            <div class="d2">
                <a class ="l1" href="ListeDesPlats.php"><img class="i1" src="Plats.jpg" width ="200" height="130" alt="My plats"></a>
                <a class ="l1" href="ListeDesPlats.php">Liste des plats</a>&nbsp
            </div>
            <div class="d2">
                <a class ="l1" href="ListeDesDesserts.php"><img class="i1" src="dessert.jpg" width ="200" height="130" alt="My dessert"></a>
                <a class ="l1" href="ListeDesDesserts.php">Liste des Desserts</a>&nbsp
            </div>
            <div classe="d2">
                <p> Vous pouvez également retrouvé la</p>
                <a class="l1" href="Localites.php">Liste de tous nos plats locaux</a>&nbsp
            </div>
        </center>
        </ul>
    </nav>
    <footer class="mainFooter">
    <p><address>Propriétaires : OSAJ Xhavit et RAMAROSON Johan</address></p>
    <p><address>Adresse :  rue des maréchals coordonniers</address></p>
    <p><address>Numéro de telephone :  07 59 44 87 49 </address></p>
    </footer>
</body>

</html>