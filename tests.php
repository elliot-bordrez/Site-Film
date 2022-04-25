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
        $Crud ='0';
        if(isset($_POST["FilmSubmit"])){
            if(!empty($_POST["NomFilm"])){
                $Crud = 'C';
                $NomFilm = $_POST["NomFilm"];
            }
        }

        if($Crud!='0'){
            try{
                $MaBase = new PDO('mysql:host=mysql-bordrezcesar.alwaysdata.net;dbname=bordrezcesar_film', '256339_alexis', 'bordrez0908cesar2207');
                if($MaBase){
                    switch ($Crud){
                        case 'C':
                            $req = "INSERT INTO `FILM`( `Nom`) VALUES ('".$NomFilm."')";
                            $RequetStatement = $MaBase->query($req);

                            if($RequetStatement){
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

    <div class="header"> 
        <img src="assets/logo.png" width="120" alt="logo">
    </div>

    <div class = "affiche">
        <form action="" method="post" class="form-example">
            <label for="NomFilm">Nom du film </label>
            <input type="text" name="NomFilm" id="NomFilm" required>

            <input type="submit" name="FilmSubmit" value="Ajouter">
        </form>

    <?php
    try {
        $MaBase = new PDO('mysql:host=mysql-bordrezcesar.alwaysdata.net;dbname=bordrezcesar_film', '256339_alexis', 'bordrez0908cesar2207');
        $resultat = $MaBase->query("SELECT * FROM FILM");

        echo "<table border='1'>";
        echo "<tr><td>Film</td><td>Note</td></tr>\n";
        while ($tab = $resultat->fetch()){
            echo "<tr><td> {$tab['Nom']}</td></tr>\n";
        }
        echo "</table>";

    }catch(exception $e){
        die('Erreur '.$e->getMessage());
    }
    ?>
    </div>

</body>
</html>