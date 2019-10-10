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

</style>

</head>

<body>

<?php
$bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307);
session_start();
$id = $_SESSION['idtresor'];
$pseudo = $_SESSION['pseudo'];
$tlk= mysqli_query($bdd,"SELECT * FROM tresor WHERE  Idtresor = '$id'");
$t= mysqli_query($bdd,"SELECT * FROM enigme WHERE  Idtresor = '$id'");

echo '<table border=1 >';
    	echo "<tr><th>Id du trésor</th><th>Nom du trésor</th><th>Objet 1</th><th>Objet 2</th><th>Objet 3</th><th>nouvel objet 1</th><th>nouvel objet 2</th><th>nouvel objet 3</th><th>date d'ajout</th><th>date de remplacement</th><th>Description</th><th>Lieu</th><th>Statut du trésor</th><th>photo</th><tr>";
while ($donnees4 = mysqli_fetch_assoc($tlk) )
{
	echo '<tr><td>',$donnees4['Idtresor'],'</td><td>',$donnees4['nomtresor'],'</td><td>',$donnees4['objet1'],'</td><td>',$donnees4['objet2'],'</td><td>',$donnees4['objet3'],'</td><td>',$donnees4['objet1change'],'</td><td>',$donnees4['objet2change'],'</td><td>',$donnees4['objet3change'],'</td><td>',$donnees4['date'],'</td><td>',$donnees4['dateT'],'</td><td>',$donnees4['DescriptionBoite'],'</td><td>',$donnees4['Lieu'],'</td><td>',$donnees4['statutTresor'],'</td><td>',$donnees4['photo'],'</td></tr>';

}
?>
<br/>
<br/>
<br/>
<?php
echo '</table>';
echo '<table border=1 >';
    	echo "<tr><th>enigme</th><th>niveau enigme</th></tr>";

while ($donnees5 = mysqli_fetch_assoc($t) )
{
	echo '<tr><td>',$donnees5['enigme'],'</td><td>',$donnees5['niveau'],'</td></tr>';

}
$id1 = mysqli_query($bdd,"SELECT idutilisateur FROM utilisateur WHERE '$pseudo' = pseudo");
while ($donnea = mysqli_fetch_assoc($id1))
{	
	$donnea['idutilisateur'];
	$b = $donnea['idutilisateur'];
}
if (isset($_POST['formRecherche']))
{
$ajout = mysqli_query($bdd,"INSERT INTO statistique (idutilisateur,Idtresor) VALUES('$b','$id')");
$sql2 = mysqli_query($bdd,"SELECT max(NbRechercher) FROM statistique WHERE '$b' = idutilisateur UNION SELECT max(NbRechercher) FROM statistique where '$id' = Idtresor");

	while ($donne2 = mysqli_fetch_assoc($sql2))
		{
		$donne2['max(NbRechercher)'];
		$num = $donne2['max(NbRechercher)'];
	}
	$num = $num + 1;
	$requete = mysqli_query($bdd,"UPDATE statistique SET NbRechercher='$num' WHERE idutilisateur='$b' AND idtresor = '$id'");
}
?>

<div class='lien'>
<p><a href='accueilCO.php'>Revenir à l'accueil</a></p>
</div>

</body>
</html>