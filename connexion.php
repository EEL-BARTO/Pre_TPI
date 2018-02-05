<?php

//Description:Formulaire d'inscription
// Date: 18.06.2016
// Auteur:VFI  
//########################## Traitement (SESSION) ############################################
session_start();
extract($_SESSION); // $pseudo
if(isset($pseudo1))
{
    echo "<html><a href='connexion.php'>$pseudo1</a></html>";
}





//########################## Connexion DB ############################################
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=tpi;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}



//########################## Traitement (POST) ############################################
extract($_POST); // $pseudo , $password . $mail . $pseudo_connexion . $password_connexion $deco . $marque . $modele


if(isset($pseudo) && isset($password) && isset($mail))
{
    $stmt = $bdd->prepare('INSERT INTO `user` (`id_user`, `pseudo`, `password`, `mail`) VALUES (NULL, ?, ?, ?)');
    $stmt->bindParam(1, $pseudo);
    $stmt->bindParam(2, $password);
    $stmt->bindParam(3, $mail);
    $stmt->execute();
    echo"<script language=\"javascript\"> alert('inscription réussie') </script>";
}




if(isset($password_connexion) && isset($password_connexion))
{    
        //On obtient une table existe qui contient le nombre d'entrée correspondant au couple pseudo password
        $query = "SELECT COUNT(*) AS existe FROM user WHERE `pseudo` LIKE '$pseudo_connexion' AND `password` LIKE '$password_connexion' ";
        $stmt = $bdd->query($query) or die ("<br>SQL Error in: <br> $query<br>Error message:".$bdd->errorInfo()[2]); 
        $ident = $stmt->fetch();
        if($ident['existe']>0)
        {
            $_SESSION['pseudo1'] = $pseudo_connexion;
            $query = "SELECT id_user FROM `user` WHERE `pseudo` LIKE '$pseudo_connexion'";
            $stmt = $bdd->query($query) or die ("<br>SQL Error in: <br> $query<br>Error message:".$bdd->errorInfo()[2]); 
             $ident = $stmt->fetch();
            extract($ident); // $id_user from dbssssssssssssssssssssssssssssssssssssssssss
            $_SESSION['id_user1'] = $id_user;
            print_r($_SESSION);
        }
        else 
        {
            echo'not ok';
        }
}




if(isset($deco))
{
    $_SESSION = array ();
    session_destroy();
    
}

if(isset($marque) && isset($modele))
{
    $stmt = $bdd->prepare('INSERT INTO `ad` (`id_ad`, `marque`, `modele`, `fk_user`) VALUES (NULL, ?, ?, ?)');
    $stmt->bindParam(1, $marque);
    $stmt->bindParam(2, $modele);
    $stmt->bindParam(3, $id_user1);
    $stmt->execute();
}


// ################################# Affichage du contenu de la page ##############################
if(isset($pseudo1))
{
     echo'<form name="formulairex" method="post" action="connexion.php">
                            <br><br><label>Marque:</label><br>
                            <input class="Test" type="text" size="40" name="marque"><br><br>
                            <label>Modèle:</label><br>
                            <input class="Test" type="text" size="40" name="modele"><br><br>
                            <button type="submit">ajouter</button>
                        </form><br><br></div></div>
     
     <form name="formulaired" method="post" action="connexion.php"> <button name="deco" value="deco" type="submit">deconnexion</button></form>';   
            $query = "SELECT * FROM `ad` WHERE `fk_user` = $id_user1 ";
            $stmt = $bdd->query($query) or die ("<br>SQL Error in: <br> $query<br>Error message:".$bdd->errorInfo()[2]); 
    echo"<table>";    
    while($ident = $stmt->fetch())
        {
            extract ($ident); //$marque $model
            echo"<tr><td>$marque</td><td>$modele</td></tr>";
        }
    echo"</table>";
}
else
{
     echo '<form name="formulaire" method="post" action="connexion.php">
                            <br><br><label>Nom:</label><br>
                            <input class="Test" type="text" size="40" name="pseudo" id="Name"><br><br>
                            <label>Mot de Passe:</label><br>
                            <input type="password" size="40" name="password"> <br><br>
                            <label>Confirmer votre mot de passe:</label><br>
                            <input type="password" size="40" name="Confirmmot_de_passe"> <br><br>
                            <label>E-mail:</label><br>
                            <input type="text" size="40" name="mail" id="email" onkeypress="return verif(event, id);"><br><br><br>
                            <button type="submit">S\'inscrire</button>
                        </form><br><br></div></div>';

        echo'<form name="formulaire_connexion" method="post" action="connexion.php">
                            <br><br><label>Nom:</label><br>
                            <input class="Test" type="text" size="40" name="pseudo_connexion" id="Name">*%%<br><br>
                            <label>Mot de Passe:</label><br>
                            <input type="password" size="40" name="password_connexion"><br><br><br>
                            <button type="submit">connexion</button>
                        </form>';

  
}
?>
