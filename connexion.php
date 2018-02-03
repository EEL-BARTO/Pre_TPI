<?php

//Description:Formulaire d'inscription
// Date: 18.06.2016
// Auteur:VFI  

//########################## Traitement (POST) ############################################
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
// ################################# Affichage du contenu de la page ##############################

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM user');

// On affiche chaque entrée une à une
/*while ($donnees = $reponse->fetch())
{ 
 echo'    <strong>Jeu</strong> : <?php echo $donnees["pseudo"]; ?><br />
    Le possesseur de ce jeu est : <?php echo $donnees["mail"]; ?>, et il le vend à <?php echo $donnees["password"]; ?> euros !<br />
    Ce jeu fonctionne sur et on peut y jouer à <?php echo $donnees["id_user"]; ?> au maximum<br />
    /em>
   </p>';
}

$reponse->closeCursor(); // Termine le traitement de la requête

*/
?> 
<?php   echo '<form name="formulaire" method="post" action="connexion.php">
                        <br><br><label>Nom:</label><br>
                        <input class="Test" type="text" size="40" name="pseudo" id="Name"><br><br>
                        <label>Mot de Passe:</label><br>
                        <input type="password" size="40" name="paassword"> <br><br>
                        <label>Confirmer votre mot de passe:</label><br>
                        <input type="password" size="40" name="Confirmmot_de_passe"> <br><br>
                        <label>E-mail:</label><br>
                        <input type="text" size="40" name="mail" id="email" onkeypress="return verif(event, id);"><br><br><br>
                        <button type="submit">S\'inscrire</button>
                    </form><br><br></div>';
?>
