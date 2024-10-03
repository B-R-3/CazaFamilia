<?php
include "fonction.inc.php";

session_start();

if(array_key_exists('Valider', $_POST)) {
    if(isset($_POST["login"]) && isset($_POST["mot_de_passe"]) && isset($_POST["email"])){
        setUser($_POST["login"],$_POST["mot_de_passe"],$_POST["email"]);
    }
}

function setUser($log,$mdp,$mail){
    
    // Connexion à la base de données
    $dbh = connexion();
    $sql = "INSERT INTO _user (login, mot_de_passe, email) VALUES (:login, :mot_de_passe, :email)";

    try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':login' => $log,
        ':mot_de_passe' => $mdp,
        ':email' => $mail,
    ));
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
  }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

   
</head>
<body>
    <header >
        <h1>CazaFamilia</h1>
        <h2 >Inscription</h2>
        <?php
        include "menu.php"
        ?>
    </header>

<form method="POST">

    <label for="login" >Pseudo</label><br>
    <input type="text" id="login" name="login" /><br>

    <label for="mot_de_passe" >Mots de passe</label><br>
    <input type="password" id="mot_de_passe" name="mot_de_passe"/><br>

    <label for="email" >Email</label><br>
    <input type="text" id="email" name="email"/><br><br>

    <button type="submit" name="Valider">Valider</button><br><br>

    <button type="reset" name="Annuler">Annuler</button><br><br>

</form>

<footer>
<p>Copyright 2024 -  CazaFamilia  | BTS SIO | Adrien CACHOUX - Romain CANER - Baptiste FOUCHARD - Brandon MOLINA-SERNA</p>
</footer>
</body>
</html>