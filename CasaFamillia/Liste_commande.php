<?php

include "fonction.inc.php";
session_start();


// connexion à la base de données
$dbh = connexion();

$sql = "SELECT c.* FROM commande c ";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
} 

foreach ($rows as &$row) {
    $sql1 = "SELECT * FROM lignecommande WHERE id_commande = :id_commande";
    try {
        $sth = $dbh->prepare($sql1);
        $sth->execute(
            [':id_commande' => $row['id_commande']]
        );
        $lignes = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $row['lignes'] = $lignes;
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

// Envoi du contenu au format JSON
$json = json_encode($rows,JSON_PRETTY_PRINT);
file_put_contents("mousquetaires.json",$json);
 // Renvoie à la page d'accueil car rien ne s'affiche dans le navigateur





?>