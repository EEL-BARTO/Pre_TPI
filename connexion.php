<?php
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

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM user');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <strong>Jeu</strong> : <?php echo $donnees['pseudo']; ?><br />
    Le possesseur de ce jeu est : <?php echo $donnees['mail']; ?>, et il le vend à <?php echo $donnees['password']; ?> euros !<br />
    Ce jeu fonctionne sur et on peut y jouer à <?php echo $donnees['id_user']; ?> au maximum<br />
    /em>
   </p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>
