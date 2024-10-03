<?php
include "fonction.inc.php";
session_start();

// Redirige vers la page de connexion si on n'est pas connecté
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}


// Connexion à la base de données
$dbh = connexion();
print_r($_SESSION);

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user']: '';
$sql = 'select libelle from produit where id_produit =:id_produit';
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ":id_produit" => $id_produit
    ));
    $rows = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}


    $sql = "select idfaq,pseudo,question,reponse,datequestion, datereponse  from faq as F, user as U where F.iduser = U.iduser and id_produit = :id_produit;";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ":id_produit" => $id_produit
        ));
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
    <title>Liste des produits</title>
</head>
<body>
    <a href="index.php">Deconnexion</a>
    
    <h1>Liste des produits disponibles</h1>
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
                <td>prjrjnh</td>
                <td>fgiehg</td>
                <td><input type="number" name="nombre" placeholder="ex: 2"></td>
            </tr>
            <tr>
                <td>prjrjnh</td>
                <td>fgiehg</td>
                <td><input type="number" name="nombre" placeholder="ex: 6"></td>
            </tr>
            <tr>
                <td>prjrjnh</td>
                <td>fgiehg</td>
                <td><input type="number" name="nombre" placeholder="ex: 1"></td>
            </tr>

           
        </table>
    </div>
    <p>
            <input type="checkbox" name="Surplace" value="oui">A emporter
            <input type="checkbox" name="emporter" value="oui">Sur place <br><br>
            <a href="validation.php"> <input type="button" name="valider" value="valider"></a>
    </p>

</body>
</html>