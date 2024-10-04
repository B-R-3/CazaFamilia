<?php
include "fonction.inc.php";
session_start();

// Connexion à la base de données
$dbh = connexion();

$message = "";

// Récupère le contenu du formulaire
$pseudo = isset($_POST['login']) ? $_POST['login'] : '';
$mdp = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
$submit = isset($_POST['submit']);
$annuler = isset($_POST['annuler']);

// Vérifie le user
if ($submit) {
    $sql = "select * from _user where login=:login ";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(
            array(
                ':login' => $pseudo,   
            )
        );
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    if (count($rows) == 1 && password_verify($mdp,$rows[0]["mdp"])) { 
        $_SESSION['login'] = $rows[0];
        header("Location: Index.php");
        exit();
    } else {
        echo "pseudo et/ou mdp invalide";
    }
}

if ($annuler) {
    header("Location: inscription.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CazaFamilia/title>
</head>



<body>
    <nav>
        <div class="logo">
            <h1><a href="index.php">CazaFamillia</a></h1>
        </div>
    </nav>

    <br>
    <div class="bigcontainer">

<?php
require_once "menu.php";
?>
        <div class="container">
            <form id="formulaire" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="cont">
                    <h1>Connexion</h1>
                    <label for="pseudo">Identifiant</label> <br>
                    <input type="text" id="pseudo" name="login" placeholder="identifiant"> <br>


                    <label for="mdp">mot de passe</label> <br>
                    <input type="password" id="mdp" name="mot_de_passe" placeholder="password"> <br><br><br>

                    <div class="but-general">
                        <input type="submit" name="submit" value="Connexion"/>
                        <input type="submit" name="annuler" value="Annuler">

                    </div>
                </div>
        </div>
        </form>

        <p></p>

</body>

</html>
