<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Accueil</title>
    <link rel='stylesheet' type='text/css' media='screen' href='accueil.css'>
    <link rel="icon" href="">
</head>
<body>
    <?php
    //On récupére les données du formulaire
        $Crud ='0';
        if(isset($_POST["FilmSubmit"])){
            //Verification du contenu des champs
            if(!empty($_POST["NomFilm"] && $_POST["NoteFilm"])){
                //Insertion des champs dans les tables
                $Crud = 'C';
                $NomFilm = $_POST["NomFilm"];
                $NoteFilm = $_POST["NoteFilm"];
            }
        }
         //Connexion a la BDD avec PDO
        if($Crud!='0'){
            try{
                //Le PDO attend des paramétre comme le nom de la base , le user avec son mot de pass
                $MaBase = new PDO('mysql:host=localhost:3306;dbname=bordrezcesar_film', 'root', 'root');
                //Si la connexion est vrai alors on continue
                if($MaBase){
                    //Switch pour gérer les requettes
                    switch ($Crud){
                        case 'C':
                            //On crée la requête
                            $req = "INSERT INTO `FILM`( `Nom`, `Note`) VALUES ('".$NomFilm."','".$NoteFilm."')";
                            $RequetStatement = $MaBase->query($req);
                            //Vérification du statement
                            if($RequetStatement){
                                //Si la BDD répond '00000' alors c'est ok
                                if( $RequetStatement->errorCode()=='00000'){
                                    echo "";
                                }else{
                                    echo "Erreur N°".$RequetStatement->errorCode()." lors de l'insertion";
                                }
                            }else{
                                echo "Erreur dans le format de la requête";
                            }
                            break;
                        case 'R':
                            echo "<p> Vous avez fait une selection de film </p>";
                            break;
                        case 'U':
                            echo "<p> Vous avez fait une update de film </p>";
                            break;
                        case 'D':
                            echo "<p> Vous avez fait une suppression de film </p>";
                            break;
                        default:
                        echo "<p> Vous n'avez pas fait de requête CRUD </p>";
                            break;
                                }
                            }
                    }catch(Exception $e){
                        $e->getMessage();
                }
            }
    ?>
<!--On crée le header-->
    <div class="header"> 
        <img src="assets/logo.png" width="120" alt="logo">
    </div>
<!--On va maintenant afficher le formulaire pour inserer un film-->
    <div class = "affiche">
        <form action="" method="post" class="form-example">
            <label for="NomFilm">Nom du film</label>
            <input type="text" name="NomFilm" id="NomFilm" required>
            <label for="NoteFilm">Note</label>
            <select name="NoteFilm" id="NoteFilm">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
        </select>

            <input type="submit" name="FilmSubmit" value="Ajouter">
        </form>
    <!--Requete pour récuperer les données que l'utlisateur a saisie-->
    <?php
    try {
        $MaBase = new PDO('mysql:host=localhost:3306;dbname=bordrezcesar_film', 'root', 'root');
        $reqFilm = $MaBase->query("SELECT * FROM FILM ORDER BY Note DESC");
    ?>
        <!--On crée un tableau pour rangée les films ainsi que les notes-->
        <table width="100%" border="1" cellpadding="5">
            <tr>
                <th>Nom Film</td>
                <th>Note Film</td>
            </tr>
        <?php
        //On affiche le résultat
        while ($tab = $reqFilm->fetch()){
            echo "<tr><td> {$tab['Nom']}</td><td>{$tab['Note']} ⭐</td></tr>\n";
        }
    }catch(exception $e){
        die('Erreur '.$e->getMessage());
    }
    ?>
    <p></p>
</div>
</body>
</html>