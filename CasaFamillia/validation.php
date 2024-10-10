<?php
session_start();
include "fonction.inc.php";
print_r($_SESSION);
print_r($_GET);

// Connexion à la base de données
$dbh = connexion();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    die("Erreur : Utilisateur non connecté.");
}

$id_user = $_SESSION['id_user'];

// Initialisation des variables

$type_conso = isset($_POST["type_conso"]) ? $_POST["type_conso"] : '';
$qte = isset($_POST['qte']) ? $_POST['qte'] : array(); // Capture les quantités
$produits_commande = array(); // Initialisation à un tableau vide
$total_commande = 0; // Initialisation à 0

// Récupérer les produits commandés de la base de données
// Exemple : SELECT produit, prix_ht FROM produits WHERE id_user = :id_user
// Simulation des produits (ceci doit être remplacé par votre logique réelle)
$produits_commande = [
    ['libelle' => 'Produit A', 'prix_ht' => 10.0, 'qte' => 2, 'total' => 20.0],
    ['libelle' => 'Produit B', 'prix_ht' => 15.0, 'qte' => 1, 'total' => 15.0],
];

// Calcul du total de la commande
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

    <h2>Type de consommation : <?php echo htmlspecialchars($type_conso); ?></h2>
    <p>Date de la commande : <?php echo date("Y-m-d H:i:s"); ?></p>

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
