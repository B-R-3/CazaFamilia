<?php
session_start();
include "fonction.inc.php";

// Connexion à la base de données
$dbh = connexion();

// Récupérer l'ID de la commande passée (par exemple, via session ou GET)
$id_commande = isset($_GET['id_commande']) ? $_GET['id_commande'] : null;

if (!$id_commande) {
    die("ID de commande non spécifié.");
}

// Récupérer les informations de la commande (type de consommation)
$sql = "SELECT type_conso, _date FROM commande WHERE id_commande = :id_commande";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':id_commande' => $id_commande));
    $commande = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        die("Commande introuvable.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la requête SQL : " . $e->getMessage());
}

// Récupérer les produits de la commande
$sql = "
    SELECT produit.libelle, produit.prix_ht, lignecommande.qte, (produit.prix_ht * lignecommande.qte) AS total
    FROM lignecommande
    JOIN produit ON produit.id = lignecommande.id_produit
    WHERE lignecommande.id_commande = :id_commande
";

try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':id_commande' => $id_commande));
    $produits_commande = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la requête SQL : " . $e->getMessage());
}

// Calculer le total de la commande
$total_commande = 0;
foreach ($produits_commande as $produit) {
    $total_commande += $produit['total'];
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

    <h2>Type de consommation : <?php echo htmlspecialchars($commande['type_conso']); ?></h2>
    <p>Date de la commande : <?php echo htmlspecialchars($commande['_date']); ?></p>

    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Prix unitaire (HT)</th>
            <th>Quantité</th>
            <th>Total (HT)</th>
        </tr>
        <?php foreach ($produits_commande as $produit) : ?>
            <tr>
                <td><?php echo htmlspecialchars($produit['libelle']); ?></td>
                <td><?php echo number_format($produit['prix_ht'], 2); ?> €</td>
                <td><?php echo htmlspecialchars($produit['qte']); ?></td>
                <td><?php echo number_format($produit['total'], 2); ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total de la commande (HT) : <?php echo number_format($total_commande, 2); ?> €</h3>

    <p><a href="index.php">Retour à l'accueil</a></p>
</body>
</html>
