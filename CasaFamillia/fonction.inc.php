<?php

function connexion()
{
  $dsn = 'mysql:host=localhost;dbname=caza familia';
  $user = 'root';
  $password = '';

  try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>
    "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
  }
  return $dbh;
}
function verifUtilisateurConnecte() {
    // Démarre la session si elle n'a pas encore été démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['user']['id_user'])) {
        // Redirige vers la page de connexion si non connecté
        header("Location: index.php");
        exit(); // Assure-toi que le script s'arrête après la redirection
    }
}


function deconnexion()
{
  //$dbh = NULL;
  unset($dbh);
}
