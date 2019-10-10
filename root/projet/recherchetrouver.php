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

	fieldset{
		border-radius: 10px;
		padding:16px;
		color: white;
		background-color:rgb(153,122,141);
	}

	p{
		color: white;
	}
</style>


<title>Changer les objets</title>

</head>

<body>
<?php
session_start();
$bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307);
$trouver="trouver";
$idtresor = $_SESSION['idtresor'];
$objet =mysqli_query($bdd, "SELECT nomtresor, objet1, objet2, objet3 FROM tresor WHERE '$idtresor' = Idtresor ");
$pseudo = $_SESSION['pseudo'];
$id = mysqli_query($bdd,"SELECT idutilisateur FROM utilisateur WHERE '$pseudo' = pseudo");
while ($donnea = mysqli_fetch_assoc($id))
{	
	$donnea['idutilisateur'];
	$b = $donnea['idutilisateur'];
}

while($affiche = mysqli_fetch_assoc($objet))
{
    echo '<table border = 1 >';
    echo "<tr><th>Nom du trésor</th><th>objet1</th><th>objet2</th><th>objet3</th><tr>";
    echo '<tr><td>',$affiche['nomtresor'],'</td><td>',$affiche['objet1'],'</td><td>',$affiche['objet2'],'</td><td>',$affiche['objet3'],'</td></tr>';
    echo '</table>';
}

if (isset($_POST['formchanger']))
{
	$objetc1  = $_POST['objetc1'];
	$objetc2  = $_POST['objetc2'];
	$objetc3  = $_POST['objetc3'];
	$date = $_POST['datechange'];
	
	$ajout = mysqli_query($bdd,"INSERT INTO statistique (idutilisateur,Idtresor) VALUES('$b','$idtresor')");

	$sql2 = mysqli_query($bdd,"SELECT max(NbTrouver) FROM statistique WHERE '$b' = idutilisateur UNION SELECT max(NbTrouver) FROM statistique where '$idtresor' = Idtresor");
	while ($donne2 = mysqli_fetch_assoc($sql2))
		{
		$donne2['max(NbTrouver)'];
		$num = $donne2['max(NbTrouver)'];
	}
	$num = $num + 1;

	$sql3 = mysqli_query($bdd,"SELECT max(NbTrouver) FROM tresor WHERE '$idtresor' = Idtresor");
	while ($donne3 = mysqli_fetch_assoc($sql3))
	{
		$donne3['max(NbTrouver)'];
		$nums = $donne3['max(NbTrouver)'];
	}
	$nums = $nums + 1;
	if (!empty($_POST['datechange']))
	{
		if (!empty ($_POST['objetc1']) OR !empty ($_POST['objetc2']) OR !empty ($_POST['objetc3']) AND !empty($_POST['datechange']))
		{
			if (!empty ($_POST['objetc1']) AND empty($_POST['objetc2']) AND empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet1change= '$objetc1', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}
			if (empty ($_POST['objetc1']) AND !empty($_POST['objetc2']) AND empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet2change= '$objetc2', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}	
			if (empty ($_POST['objetc1']) AND empty($_POST['objetc2']) AND !empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet3change= '$objetc3', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}
			if (!empty ($_POST['objetc1']) AND !empty($_POST['objetc2']) AND empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet1change= '$objetc1', objet2change= '$objetc2', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}
			if (!empty ($_POST['objetc1']) AND empty($_POST['objetc2']) AND !empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet1change= '$objetc1', objet3change= '$objetc3', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}
			if (empty ($_POST['objetc1']) AND !empty($_POST['objetc2']) AND !empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet2change= '$objetc2', objet3change = '$objetc3', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");
			}
			if (!empty ($_POST['objetc1']) AND !empty($_POST['objetc2']) AND !empty($_POST['objetc3']))
			{
					$remplace=mysqli_query($bdd, "UPDATE tresor SET  objet1change= '$objetc1', objet2change= '$objetc2', objet3change= '$objetc3', statutTresor = '$trouver', dateT = '$date',NbTrouver = '$nums' WHERE Idtresor = '$idtresor'");
					$requete = mysqli_query($bdd,"UPDATE statistique SET NbTrouver='$num' WHERE idutilisateur='$b' AND idtresor = '$idtresor'");	
			}
			header('Location:accueilCO.php');
			die();
		}
		else
		{
				$erreur = "Veuillez remplir au moins 1 champ et la date";
		}
	}
	else
	{
		$erreur = "Veuillez renseigner la date";
	}

}

?>

<div align ="center">
	<h3>Changer les objets</h3>
	<br /><br />
	<form method="POST" action="">
		<fieldset name="changer" style="width:360px;"> 
			<legend> Changer </legend>
				<table>
					<tr>
						<td>
						<label for="objetc1"> objet 1 :</label>
						</td>
							<td>
								<input type="text" name = "objetc1" placeholder ="Saisir le nouvel objet" id="objetc1">
							</td>
						</tr>
						<tr>
						<td>
						<label for="objetc2"> objet 2 :</label>
						</td>
							<td>
								<input type="text" name = "objetc2" placeholder ="Saisir le nouvel objet" id="objetc2">
							</td>
						</tr>
						<tr>
						<td>
						<label for="objetc3"> objet 3 :</label>
						</td>
							<td>
								<input type="text" name = "objetc3" placeholder ="Saisir le nouvel objet" id="objetc3">
							</td>
						</tr>
						<tr>
						<td>
						<label for="datechange"> Date de change :</label>
						</td>
							<td>
								<input type="date" name="datechange" id="datechange">
							</td>
						</tr>	
					<br/>
					</table>
					<input type="submit" name="formchanger">
				</fieldset>
				<p> Veuillez ne pas remplacer des objets déjà inexistants ! </p>
				<?php
				if(isset($erreur))
				{
					echo $erreur;
				}
				?>
		</form>
</body>
</html>
	