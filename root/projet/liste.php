<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
	*{
		font-family: Arial, Helvetica, sans-serif;
	}
	body {
	    background-image: url("champ.jpg");
	    margin: auto;
	}

	h1{
		color: white;
		text-align: center;
	}

	table{
		color: white;
		background-color:rgb(153,122,141);
		border-collapse: collapse;
	    margin: auto;
	    padding-top: 4;
	}

	p{
		text-align: center;
	}

	a:link {
	    color: white;
	}

	/* visited link */
	a:visited {
	    color: white;
	}

	/* mouse over link */
	a:hover {
	    color: black;
	}

	/* selected link */
	a:active {
	    color: black;
	}
	</style>


<title>Liste des trésors</title>

</head>

<body>



<?php

$bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307);

if($bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307))
{
	// Si la connexion a réussi, rien ne se passe.
}
else // Mais si elle rate…
{
	echo 'Erreur'; // On affiche un message d'erreur.
}


$Recherche = mysqli_query($bdd, 'SELECT * from tresor');


if (isset($_POST['formRecherche']))
{
	$idtresor = $_POST['idtresor'];
	session_start();
	$_SESSION['idtresor'] = $idtresor;
	header('Location:details.php');
	
	die();
}


?>

<h1>Chasse au trésor !</h1>

<br/>
<br/>
<br/>

<?php

//$rec11 = mysqli_query($bdd,"SELECT idutilisateur FROM tresor ") ;
//$rec = mysqli_query($bdd,"SELECT * FROM utilisateur where idutilisateur = '$rec11' ") ;
echo '<table border=1 >';
    	echo "<tr><th>Id du trésor</th><th>Nom du trésor</th><th>date ajout</th><th>Description</th><th>Lieu</th><th>Statut du trésor</th><th>nombre de fois trouver</th><tr>";

while($donnees4 = mysqli_fetch_assoc($Recherche))
{
 	echo '<tr><td>',$donnees4['Idtresor'],'</td><td>',$donnees4['nomtresor'],'</td><td>',$donnees4['date'],'</td><td>',$donnees4['DescriptionBoite'],'</td><td>',$donnees4['Lieu'],'</td><td>',$donnees4['statutTresor'],'</td><td>',$donnees4['NbTrouver'],'</td></tr>';
}
echo '</table>';

/*echo '<table border=1 >';
    	echo "<tr><th>nom du cacheur</th><tr>";

	while($donnees7 = mysqli_fetch_assoc($rec))
{
	
 	echo '<tr><td>',$donnees7['pseudo'],'</td><td>','</td></tr>';
 }

echo '</table>';
*/
?>
<br/>
<form method="POST" action="">
<label for="idtresor">Affichier le tresor : </label>

<input type = "texte"
	
	name = "idtresor"
	placeholder ="Idtresor"
	size = "10"
	id = "idtresor" >
<input type = "submit" name = "formRecherche">

<div class='lien'>
<p><a href='accueilCO.php'>Revenir à l'accueil</a></p>
</div>

</body>

</html>