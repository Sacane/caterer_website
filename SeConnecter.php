<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <header><h1>Saisissez vos informations pour accéder au site</h1></header>
    <form method="POST" action="verif.php">
        <table>
            <tr>
                <td>Prenom</td><td><input type="text" name="prenom"/></td>
            </tr>
            <tr>
                <td>Nom</td><td><input type="text" name="nom"/></td>
            </tr>
        </table>
        <input type="submit" name="client" value="Se connecter"/>
</body>
</html>