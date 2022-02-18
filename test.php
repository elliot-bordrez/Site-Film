<!DOCTYPE html >
< html >
< tête >
    < meta  charset =' utf-8 ' >
    < titre > Accueil </ titre >
    < lien  rel =' stylesheet ' type =' text/css ' media =' screen ' href =' accueil.css ' >
    < lien  rel =" icône " href ="" >
</ tête >
< corps >
    <?php
        $ Crud = '0' ;
        if ( isset ( $ _POST [ "FilmSubmit" ])){
            si (! vide ( $ _POST [ "NomFilm" ])){
                $ Crud = 'C' ;
                $ NomFilm = $ _POST [ "NomFilm" ];
            }
        }

        si ( $ Crud != '0' ){
            essayer {
                $ MaBase = nouveau  PDO ( 'mysql:host=mysql-bordrezcesar.alwaysdata.net;dbname=bordrezcesar_film' , '256339_alexis' , 'bordrez0908cesar2207' );
                si ( $ MaBase ){
                    interrupteur ( $ Crud ) {
                        cas  'C' :
                            $ req = "INSERT INTO `FILM`( `Nom`) VALUES ('" . $ NomFilm . "')" ;
                            $ RequetStatement = $ MaBase -> requête ( $ req );

                            if ( $ RequetStatement ){
                                if ( $ RequetStatement -> errorCode ()== '00000' ){
                                    écho  "" ;
                                } sinon {
                                    echo  "Erreur N°" . $ RequetStatement -> errorCode (). "lors de l'insertion" ;
                                }
                            } sinon {
                                echo  "Erreur dans le format de la requête" ;
                            }
                            casser ;
                        cas  'R' :
                            echo  "<p>Vous avez fait une sélection de film </p>" ;
                            casser ;
                        cas  'U' :
                            echo  "<p>Vous avez fait une mise à jour du film </p>" ;
                            casser ;
                        cas  'D' :
                            echo  "<p>Vous avez fait une suppression de film </p>" ;
                            casser ;
                        par défaut :
                        echo  "<p>Vous n'avez pas fait de requête CRUD </p>" ;
                            casser ;
                                }
                            }
                    } catch ( Exception  $ e ){
                        $ e -> getMessage ();
                }
            }
    ?>

    < classe div  =" en-tête " > 
        < img  src =" assets/logo.png " width =" 120 " alt =" logo " >
    </ div >

    < div  class =" affiche " >
        < form  action ="" method =" post " class =" form-example " >
            < label  for =" NomFilm " > Nom du film </ label >
            < type d'entrée  =" texte " nom =" NomFilm " id =" NomFilm " requis >

            < type d'entrée  =" soumettre " nom =" FilmSubmit " valeur =" Ajouter " >
        </ formulaire >

        <?php
        if ($BasePDO){}
        $req = "SELECT * FROM FILM ORDER BY Nom DESC";
        $RequetStatement = $BasePDO->query($req);
        if($RequetStatement){
            ?>
            <form action ="" method="post" class="formSup">
                <table>
                    <?php
                    while($Tab=$RequetStatement->fetch()){
                        ?>
                        <tr>
                            <?php
                            echo "<td>".$Tab[0]."</td>";
                            if($Crud == 'U1' && $Tab[0]==$_POST["NomUpdate"]){
                                ?>
                                    <td colspan="4">
                                        <form action="" method="post">
                                            <input type="hidden" name="NomUpdate" value="<?php echo $Tab[0]?>">
                                            <input type="text" name="Nom" alue="<?php echo $Tab[1]?>" autofocus class="input">
                                            <input type="submit" name="NomUpdate2Submit" value="Valider" class="btnUpdate2">
                                         </form>
                                     </td>
                                <?php
                            }else{

                                echo'<td class="tdNom">'.$Tab[1]."</td>";
                                echo "<td>".$Tab[2]."</td>";
                            }

                            if (!($Crud == 'U1' && $Tab[0]==$_POST["NomUpdate"])){
                                ?>
                                    <td>
                                    <input type="checkbox" id="FILM_<?php echo $Tab[0]?>" name="Nom[]" value="<?php echo $Tab[0]?>">
                                    </td>
                                    <td>
                                        <form actions="" method="post">
                                            <input type="hidden" name="NomUpdate" value="<?php echo $Tab[0]?>">
                                            <input type="submit" name="NomUpdateSubmit" value="modifier" class="btnUpdate">
                                        </form>
                                    </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
    </ div >

</ corps >
</ html >