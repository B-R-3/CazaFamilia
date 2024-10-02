<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
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
</body>
</html>
