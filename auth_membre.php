<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page de connexion membres</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <header><h1>Saisissez les identifiants pour accéder au site membres</h1></header>
    <form method="POST" action="verif_membre.php">
        <table>
            <tr>
                <td>Identifiant membre</td><td><input type="text" name="id"/></td>
            </tr>
            <tr>
                <td>Mot de passe</td><td><input type="password" name="password"/></td>
            </tr>
        </table>
        <input type="submit" name="client" value="Se connecter"/>
</body>
</html>