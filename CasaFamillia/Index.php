<?php
include "fonction.inc.php";
session_start();

$dbh = connexion();

$sql1 = 'select * from produit';
try {
    $sth = $dbh->prepare($sql1);
    $sth->execute(array(
    ));
    $rows = $sth->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <title>CazaFamillia</title>
</head>

<body>
    <div class="fond_accueil">
        <div class="titre">
            <h1>Bienvenue sur la CazaFamilia !</h1>
        </div>
    </div>
    <div class="container">
        <div class="log">
            <div class="one"><a href="Connexion.php">connexion</a></div>
            <div class="sep"></div>
            <div class="one"><a href="inscription.php">inscription</a></div>
        </div>
    </div>
    <br><br><br>
    <div class="liste">
        
        <table>
        <tr>
                <th>Plats</th>
                <th>Prix</th>
            </tr>
        <?php
        foreach ($rows as $row){
            echo "<tr><td>".$row["libelle"]."</td>";
            echo "<td>".$row["prix_ht"]."€</td></tr>";
            ;

        }
           /*<tr>
                <th>Plats</th>
                <th>Prix</th>
                <th>Quantité disponible</th>
            </tr>
            <tr>
                <td>Pizza margharita</td>
                <td>15e</td>
                <td>12</td>
            </tr>
            <tr>
                <td>Lasagne</td>
                <td>12e</td>
                <td>13</td>
            </tr>
            <tr>
                <td>Tiramisu</td>
                <td>5e</td>
                <td>20</td>

            </tr>*/
           ?>
        </table>
    </div>

</body>

</html>