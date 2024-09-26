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

    <label for="Pseudo" >Pseudo</label><br>
    <input type="text" id="Pseudo" name="Pseudo" /><br>

    <label for="mdp" >Mots de passe</label><br>
    <input type="password" id="Mdp" name="Mdp"/><br>

    <label for="email" >Email</label><br>
    <input type="text" id="Mail" name="Mail"/><br><br>

    <button type="submit" name="Valider">Valider</button><br><br>

    <button type="reset" name="Annuler">Annuler</button><br><br>

</form>

<footer>
<p>Copyright 2024 -  CazaFamilia  | BTS SIO | Adrien CACHOUX - Romain CANER - Baptiste FOUCHARD - Brandon MOLINA-SERNA</p>
</footer>
</body>
</html>