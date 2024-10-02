<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Validation de la commande</title>
</head>
<body>
    <a href="index.php">Déconnexion</a>
    
    <h1>Récapitulatif de la commande</h1>
    <br>
    <br>
    
    <div class="liste">
        <table>
            <tr>
                <th>Plats</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
            <tr>
                <td>Plat 1</td>
                <td>15€</td>
                <td><input type="text" name="nombre" value="2"></td>
            </tr>
            <tr>
                <td>Plat 2</td>
                <td>10€</td>
                <td><input type="text" name="nombre" value="1"></td>
            </tr>
            <tr>
                <td>Plat 3</td>
                <td>8€</td>
                <td><input type="text" name="nombre" value="3"></td>
            </tr>
        </table>
        <p>Sur place</p>
    </div>
    
    <p>
    <a href="index.php"><button>Retour à l'accueil</button></a>
        <a href="liste.php"><input type="button" name="valider" value="Mofifier"></a>
    </p>

</body>
</html>
