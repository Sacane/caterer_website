<?php
    session_start();   
    include("connexion.php"); 


    $liste=$cnx->query('SELECT * FROM plat'); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Selection des plats</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h1> Bonjour Mr/Mme <?= htmlspecialchars($_SESSION['nom']) ?> !</h1>
        <h2> Nous vous avons séléctionner les plats qui correspondent à votre demande : </h2>

        <form method="POST" action="validation.php">


            Choix de la commande : <select name="plat">
            <option value="plat" selected="selected">Selectionner un plat</option>
            <?php while ($choix=$liste->fetch()){?>
                <option value="<?php echo $choix['nom_plat'];?>"><?php echo $choix['nom_plat']." ".'('.$choix['prix_ttc'].'€'.')';?></option>
            <?php
                } 
            ?>
            </select>
            <br><br>
            <input type='submit' name='choix' value='Annuler'>
            <input type='submit' name = 'choix' value='Continuer'>
            <input type='submit' name= 'choix' value='Valider'>
            <br><br>
            <address>("Annuler" signifie que vous annulez le choix actuel, si vous cliquez dessus nous vous renverrons vers le choix des labels et allergenes).</address>
        </form>
</body>
<?php 
include('footer.html');
?>
</html>
