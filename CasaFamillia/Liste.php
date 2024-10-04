<?php
include "fonction.inc.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Connexion à la base de données
$dbh = connexion();

print_r($_SESSION);
$type_conso = isset($_POST["type_conso"]) ? $_POST["type_conso"] : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$quantities = isset($_POST['quantite']) ? $_POST['quantite'] : array(); // Capture les quantités

$sql = 'SELECT * FROM produit';
try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

if (isset($_POST['submit'])) {
    // Insertion dans la table commande
    $sql = "INSERT INTO commande(type_conso, _date) VALUES (:type_conso, CURRENT_TIMESTAMP())";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(
            array(
                ":type_conso" => $type_conso
            )
        );

        // Récupérer l'ID de la commande insérée
        $id_commande = $dbh->lastInsertId();

        // Insertion dans la table lignecommande pour chaque produit commandé
        $sql1 = "INSERT INTO lignecommande(qte, id_produit, id_commande) VALUES (:qte, :id_produit, :id_commande)";
        $sth = $dbh->prepare($sql1);

        foreach ($quantities as $id_produit => $qte) {
            if ($qte > 0) { // Si la quantité est supérieure à 0
                $sth->execute(
                    array(
                        ":qte" => $qte,
                        ":id_produit" => $id_produit,
                        ":id_commande" => $id_commande
                    )
                );
            }
        }

        // Rediriger après insertion
        header("Location: validation.php");
        exit();

    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
}

if (isset($_POST['annuler'])) {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste des produits</title>
</head>

<body>
    <a href="index.php">Déconnexion</a>

    <h1>Liste des produits disponibles</h1>
    <br><br>

    <form id="formulaire" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <th>Plat</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>

            <?php
            foreach ($rows as $row) {
                echo '<tr><td>' . htmlspecialchars($row["libelle"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["prix_ht"]) . '€</td>';
                echo '<td><input type="number" name="quantite[' . $row["id"] . ']" min="0" max="20" placeholder="0"></td></tr>';
            }
            ?>
        </table>

        <!-- Boutons radio pour le type de consommation -->
        <p>
            <input type="radio" name="type_conso" value="emporter" required> À emporter
            <input type="radio" name="type_conso" value="surplace" required> Sur place
        </p>

        <!-- Boutons de soumission -->
        <p>
            <input type="submit" name="submit" value="Valider">
            <input type="submit" name="annuler" value="Annuler">
        </p>
    </form>
</body>
</html>
