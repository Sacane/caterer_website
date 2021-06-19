<?php 
    session_start();
    $_SESSION['livraison']=$_POST['livraison'];
?>
<DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>choix</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <form method='POST' action='choix.php'>
    <p> Vous pouvez continuer votre commande !</p>
        <input type="submit" name="submit" value="Continuer"/> <br/>
    </form>
</body>
</html>