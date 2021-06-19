<?php 
if(!empty($_SESSION)){
    header('Location: Commander.php');
    exit;
}?>

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
        La table des moulas vous souhaite bienvenue !
    </h1>
    <p id='membre'><a href='auth_membre.php'><adress>Accès uniquement aux traiteurs</adress></a></p>
</header>
<h2>Veuillez rentrer vos informations si c'est la première fois que vous nous rendez visite !</h2>
<form method="POST" action="auth.php">
    <table>
    <tr>
    <td>Prénom</td><td><input type="text" name="prenom"/></td>
    </tr>
    <tr><td>Nom</td><td><input type="text" name="nom"/></td>
    </tr>
    <tr>
    <td>Adresse</td><td><input type="text" name="adresse"/></td>
    </tr>
    <tr>
    <td>Numéro de téléphone</td><td><input type="text" name="telephone" maxlength="10" size="12"/></td>
    </tr>
    <tr><td>Numéro de carte bancaire</td><td> <input type="text" name="CB" maxlength="16" size="15"/></td>
    </tr>
    <tr><td>Cryptogramme</td><td><input type="text" name="crypto" maxlength="3" size="3"/></td>
    </tr>
    </table><br/>
    <input type="reset" name="reset" value="Annuler" /> 
    <input type="submit" name="submit" value="Valider"/>
</form>
<h3> Vous vous êtes déjà inscris ? <a href="SeConnecter.php">Cliquez ici</a> pour vous connecter.</H3>
</body>
<footer class="mainFooter">
        <p>Propriétaires : <address>OSAJ Xhavit et RAMAROSON Johan</address></p>
        <p>Adresse : <address> 34 rue des maréchals coordonniers</address></p>
        <p>Numéro de telephone : <address> 07 59 44 87 49 </address></p><br>
</footer>
</html>