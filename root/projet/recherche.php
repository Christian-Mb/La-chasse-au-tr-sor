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
	}
	h1{
		color: white;
		text-align: center;
	}
	.resultat{
		background-color: rgb(153,122,141);
		border-collapse: collapse;
		margin: auto;
		padding: 500;
	}

	p{
		text-align: center;
	}

	a:link {
	    color: red;
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

<title></title>

</head>

<body>
<?php
session_start();
$bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307);
if($bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307))
{
    // Si la connexion a réussi, rien ne se passe.
}
else // Mais si elle rate…
{
    echo 'Erreur'; // On affiche un message d'erreur.
}
$recherche = $_SESSION['recherche'];
$search =mysqli_query($bdd, "SELECT nomtresor, date, DescriptionBoite, Lieu FROM tresor WHERE '$recherche' = nomtresor");

?>

<h1>Résultat</h1>

<br/>
<table align = right>
    <td><?php echo htmlentities(trim($_SESSION['pseudo'])); ?> <td>
    <td><a href="logout.php">Déconnexion</a><td>
</table>
</br>
</br>
</br>
</br>
<p><a href='accueilCO.php'>Revenir à l'accueil</a></p>
<?php

while($donne = mysqli_fetch_assoc($search))
{
    echo '<table border = 1 class = "resultat">';
    echo "<tr><th>Nom du trésor</th><th>date d'ajout</th><th>Description</th><th>Lieu</th><tr>";
    echo '<tr><td>',$donne['nomtresor'],'</td><td>',$donne['date'],'</td><td>',$donne['DescriptionBoite'],'</td><td>',$donne['Lieu'],'</td></tr>';
}

?>
</html>
