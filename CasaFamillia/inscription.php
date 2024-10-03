<?php
include "fonction.inc.php";
session_start();

// Connexion à la base de données
$dbh = connexion();

$message = "";
// Récupère le contenu du formulaire
$login = isset($_POST['login']) ? $_POST['login'] : '';
$mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$submit = isset($_POST['submit']);
$annuler = isset($_POST['annuler']);
$_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Ajoute le user
if ($submit) {
    if ($login == !null && $mot_de_passe == !null && $email == !null) {
        $sql = "INSERT INTO _user (login, mot_de_passe, email) VALUES (:login, :mot_de_passe, :email)" ;
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(
                array(
                    ':login' => $login,
                    ':mot_de_passe' => $_hash,
                    ':email' => $email,
                )
            );
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
    } else {
        $message = "veuillez remplir tous les champs";
    }
}
if ($annuler) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Inscription</h1>
<?php
require_once "menu.php";
?>

<form method="POST">

<label for="login" >login</label><br>
<input type="text" id="login" name="login" /><br>


<label for="mot_de_passe" >Mots de passe</label><br>
<input type="password" id="mot_de_passe" name="mot_de_passe"/><br>

<label for="email" >Email</label><br>
<input type="text" id="email" name="email"/><br><br>

<input type="submit" name="submit" value="valide"><br><br>


</body>
</html>