<?php
session_start();
include "fonction.inc.php";
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Connexion à la base de données
$dbh = connexion();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    die("Erreur : Utilisateur non connecté.");
}

$id_user = $_SESSION['id_user'];

// Initialisation des variables

$type_conso = isset($_GET["type_conso"]) ? $_GET["type_conso"] : '0';
$id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';
$total_commande = isset($_GET["total_commande"]) ? $_GET["total_commande"] : '';
$qte = isset($_POST['qte']) ? $_POST['qte'] : array(); // Capture les quantités
$produits_commande = array(); // Initialisation à un tableau vide
$total_commande = 0; // Initialisation à 0
echo "type =".$type_conso;
// Récupérer les produits commandés de la base de données
// Exemple : SELECT produit, prix_ht FROM produits WHERE id_user = :id_user
// Simulation des produits (ceci doit être remplacé par votre logique réelle)
$sql = 'SELECT p.libelle, p.prix_ht, l.qte, c.total_commande FROM lignecommande as l, produit as p, commande as c where l.id_produit = p.id_produit and l.id_commande = c.id_commande and c.id_commande = :id_commande';
try {
    $sth = $dbh->prepare($sql);
    $sth->execute( 
        array(
            ":id_commande" => $id_commande
        )
    );
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Récapitulatif de la commande</title>
</head>

<body>
    <h1>Récapitulatif de la commande</h1>

    <h2>Type de consommation : <?php echo $type_conso; ?></h2>
    <p>Date de la commande : <?php echo date("Y-m-d H:i:s"); ?></p>

    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Prix unitaire (HT)</th>
            <th>Quantité</th>
            <th>Total (HT)</th>
        </tr>
        <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['libelle']); ?></td>
                <td><?php echo number_format($row['prix_ht'], 2); ?> €</td>
                <td><?php echo htmlspecialchars($row['qte']); ?></td>
                <td><?php echo htmlspecialchars($row['total_commande']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total de la commande (HT) : <?php echo number_format($row['total_commande'], 2); ?> €</h3>

    <p><a href="index.php">Retour à l'accueil</a></p>
</body>

</html>