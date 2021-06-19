<DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>choix</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <form method='POST' action='validlivraison.php'>
    <h1>Selectionnez le lieu de livraison :</h1>
        <input type="radio" name="livraison" value ="FALSE">Commander en magasin
        <input type="radio" name="livraison" value="TRUE">Se faire livrer chez soi
        <br><br>
        <input type="submit" name="submit" value="Continuer"/> <br/>
    </form>
</body>
</html>