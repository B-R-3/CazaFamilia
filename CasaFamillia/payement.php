<?php
include "fonction.inc.php";
session_start();

$dbh = connexion();
print_r($_SESSION);
print_r($_GET);


$id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';
//$id_commande= 1;
// Récupérer le login de l'utilisateur depuis la session ou toute autre source
$login = $_SESSION['login']; // Assurez-vous que le login est stocké dans la session

// Récupérer l'id_user en fonction du login
$sql_user = 'SELECT id_user, login FROM _user WHERE login = :login';
try {
    $sth = $dbh->prepare($sql_user);
    $sth->execute(array(':login' => $login));
    $user = $sth->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $login = $user['login'];
    } else {
        die("Aucun utilisateur trouvé avec ce login.");
    }
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL pour _user : " . $ex->getMessage());
}

// Requête pour récupérer les détails de la commande
$sql_lignecommande = 'SELECT * FROM lignecommande WHERE id_commande = :id_commande';
try {
    $sth = $dbh->prepare($sql_lignecommande);
    $sth->execute(array(':id_commande' => $id_commande));
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL pour lignecommande : " . $ex->getMessage());
}

// Requête pour récupérer le total de la commande
$sql_commande = 'SELECT total_commande FROM commande WHERE id_commande = :id_commande';
try {
    $sth = $dbh->prepare($sql_commande);
    $sth->execute(array(':id_commande' => $id_commande));
    $commande = $sth->fetch(PDO::FETCH_ASSOC);
    
    if ($commande) {
        $total_commande = $commande['total_commande'];
    } else {
        die("Aucune commande trouvée avec cet ID.");
    }
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL pour commande : " . $ex->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Paiement</title>
</head>
<body>
    <a href="index.php"><button>Retour à l'accueil</button></a>
    <div class="container">
        <!-- Affichage du numéro de commande, du prix total et de l'id_user -->
        <p>Voici la commande de <?php echo htmlspecialchars($login); ?></p> | Prix de la commande :  <?php echo htmlspecialchars($total_commande); ?> €</p>
      
        
        <h2>Page de Paiement</h2>
        <form action="traitement_paiement.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom sur la carte</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="numero-carte">Numéro de Carte</label>
                <input type="number" id="numero-carte" name="numero-carte" required>
            </div>
            <div class="form-group">
                <label for="date-expiration">Date d'Expiration</label>
                <input type="date" id="date-expiration" name="date-expiration" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" required>
            </div>
            <input type="submit" value="Payer">
        </form>
    </div>
    <a href="confirmation.php"><button>test de confirmation</button></a>
</body>
</html>
