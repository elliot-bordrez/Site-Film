<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Exo Final TP1 php</title>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>
    <?php
    //Traitement du formulaire de connexion
        if(isset($_POST["Valider"])){
        if($_POST["password"]=="root" && $_POST["login"]=="root" ){
            //Si le login est le mdp est bon alors la connexion est valide
            $_SESSION["EtatConnexion"]=true;
            //On envoie l'utlisateur vers le site Web
            header('Location: accueil.php');
        }      
    }
    ?>
    //Création du formulaire de connexion
    <div id="container">
    <form action="" method="post">
        <h1>Connexion</h1>
        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" id="login" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" id="password" required>

        <input type="submit" value="Valider" name="Valider" >
    </div>
    </form>
</body>
</html>