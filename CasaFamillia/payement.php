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
