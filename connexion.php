<?php

//Description:Formulaire d'inscription
// Date: 18.06.2016
// Auteur:VFI  


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
extract($_POST); // $pseudo , $password . $mail
if(isset($pseudo) && isset($password) && isset($mail))
{

$stmt = $bdd->prepare('INSERT INTO `user` (`id_user`, `pseudo`, `password`, `mail`) VALUES (NULL, ?, ?, ?)');
$stmt->bindParam(1, $pseudo);
$stmt->bindParam(2, $password);
$stmt->bindParam(3, $mail);
$stmt->execute();

 echo"<script language=\"javascript\"> alert('inscription réussie') </script>";
}
// ################################# Affichage du contenu de la page ##############################

// On récupère tout le contenu de la table jeux_video 
/*$reponse = $bdd->query('SELECT * FROM user');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{ 
 echo'    <strong>Jeu</strong> : <?php echo $donnees["pseudo"]; ?><br />
    Le possesseur de ce jeu est : <?php echo $donnees["mail"]; ?>, et il le vend à <?php echo $donnees["password"]; ?> euros !<br />
    Ce jeu fonctionne sur et on peut y jouer à <?php echo $donnees["id_user"]; ?> au maximum<br />
    /em>
   </p>';
}

$reponse->closeCursor(); // Termine le traitement de la requête
<input type="button" value="Afficher ou Maquer" onClick="masquer_div("a_masquer");"/>
   <div id="a_masquer">

*/


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
                        <input class="Test" type="text" size="40" name="pseudo_connexion" id="Name"><br><br>
                        <label>Mot de Passe:</label><br>
                        <input type="password" size="40" name="password_connexion"><br><br><br>
                        <button type="submit">connexion</button>
                    </form>';
?>
