<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
<header Connexion>
        <h1>CazaFamilia</h1>
        <h2>Connexion</h2>
        <?php
        include "menu.php"
        ?>
    </header>
  
    <form action="Connexion.php" method="post">

        <label for="Pseudo" class="login-form-label">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo"/><br>

        <label for="mdp" class="login-form-label">Mot de passe</label><br>
        <input type="mdp" id="mdp" name="mdp" /><br><br>

        <button type="submit" name="submit" ><a href="Liste.php">Ok</a></button>
        <button type="reset" name="Annuler">Annuler</button><br><br>
    </form>


    <p>Copyright 2024 -  CazaFamilia  | BTS SIO | Adrien CACHOUX - Romain CANER - Baptiste FOUCHARD - Brandon MOLINA-SERNA</p>
   
</body>
</html>