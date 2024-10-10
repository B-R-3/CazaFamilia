<?php
session_start();
include "fonction.inc.php";

// Connexion à la base de données
$dbh = connexion();

// Vérifier si l'utilisateur est connecté et que l'id_user est défini
if (!isset($_SESSION['id_user'])) {
    die("Erreur : Utilisateur non connecté.");
}

$id_user = $_SESSION['id_user'];

$type_conso = isset($_POST["type_conso"]) ? $_POST["type_conso"] : '';
$qte = isset($_POST['qte']) ? $_POST['qte'] : array(); // Capture les quantités

// Vérifier si le formulaire a été soumis
/*if (!isset($_POST['form_submitted'])) {
    die("Erreur : Accès direct interdit.");
}

// Récupération et validation du type de consommation
$type_conso = filter_input(INPUT_POST, 'type_conso');
$valid_types = ['emporter', 'surplace'];

if (!$type_conso || !in_array($type_conso, $valid_types)) {
    die("Erreur : Type de consommation non spécifié ou invalide.");
}

// Vérification des quantités
$qte = isset($_POST['qte']) ? $_POST['qte'] : [];
if (empty($qte)) {
    die("Erreur : Aucune quantité spécifiée pour les produits.");
}
*/
// Insertion de la commande dans la table commande
$sql = "INSERT INTO commande (id_user, type_conso, _date) VALUES (:id_user, :type_conso, CURRENT_TIMESTAMP())";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute([
        ':id_user' => $id_user,
        ':type_conso' => $type_conso
    ]);
    $id_commande = $dbh->lastInsertId();
} catch (PDOException $e) {
    die("Erreur lors de l'insertion de la commande : " . $e->getMessage());
}

// Le reste du code reste inchangé...
echo "baba au rhum";
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
