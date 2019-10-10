<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">


<style>
	*{
		font-family: Arial, Helvetica, sans-serif;
	}
	body {
	    background-color: lightblue;
	    background-image: url("champ.jpg");
	    margin: auto; 
	}

	h1{
		color: white;
		text-align: center;
	}

	fieldset{
		border-radius: 10px;
		padding:16px;
		color: white;
		background-color:rgb(153,122,141);
	}
	legend{
		margin-bottom:0px;
		margin-left:16px;
	}

	.CO{
        margin-right: auto;
    }

    .meilleur{
        margin-right: 400px;
        margin-left: 400px;
    }

	.nouveautés{
	    border-collapse: collapse;
	    width: 90%;
	    margin:10px;
	}

	.fpage{
		margin: auto;
	}

	/* unvisited link */
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



<title>Chasse au trésor</title>


</head>

<body>

<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
	header ('Location:accueil.php');
	exit();
}

$bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307);

if($bdd = new mysqli('localhost', 'root', 'usbw', 'projet2', 3307))
{
	// Si la connexion a réussi, rien ne se passe.
}
else // Mais si elle rate…
{
	echo 'Erreur'; // On affiche un message d'erreur.
}

?>


<?php
//selectionne le pseudo de l'utilisateur qui a trouvé le plus de trésors ce mois-ci.
$NbRecherche = mysqli_query($bdd, 'SELECT pseudo from utilisateur where idutilisateur= (select idutilisateur from statistique where NbRechercher= (select max(nbRechercher) from statistique) LIMIT 1)');

//selectionne le pseudo de l'utilisateur qui a caché le plus d'élements ce mois-ci.
$NbCache = mysqli_query($bdd, 'SELECT pseudo from utilisateur where idutilisateur= (select idutilisateur from tresor where nbCacher= (select max(nbCacher) from tresor) LIMIT 1)');


$NbTrouve = mysqli_query($bdd, "SELECT statutTresor, date from tresor where statutTresor= ('trouver') AND MONTH(date) = (SELECT MONTH(NOW())) AND YEAR(date) = (SELECT YEAR(NOW()))");

$Nouveau = mysqli_query($bdd, "SELECT nomtresor, date, DescriptionBoite, Lieu FROM tresor WHERE statutTresor= ('cacher') ORDER BY `tresor`.`date` DESC LIMIT 5");


if (isset($_POST['formrecherche']))
{
    $recherche = $_POST['recherche'];
    $pseudo = $_SESSION['pseudo'];
    session_start();
     $_SESSION['pseudo'] = $pseudo;
     $_SESSION['recherche'] = $recherche;
    header('Location:recherche.php');
    die();
}
if (isset($_POST['declarer']))
{
    $pseudo = $_SESSION['pseudo'];
    session_start();
     $_SESSION['pseudo'] = $pseudo;
    header('Location:declarerTresor.php');
    die();
}

if (isset($_POST['formrecherchetrouve']))

{

    $pseudo = $_SESSION['pseudo'];
    $idtresor = $_POST['recherchetrouve'];
    session_start();
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['idtresor'] = $idtresor;
    header('Location:recherchetrouver.php');
    die();
}

if (isset($_POST['formperdu']))
	{
		$perdu = $_POST['passerperdu'];
		$pseudo = $_SESSION['pseudo'];
		$test1 = mysqli_query($bdd,"SELECT idutilisateur FROM utilisateur WHERE pseudo ='$pseudo' ");
		while ($donneb = mysqli_fetch_assoc($test1))
		{
			$donneb['idutilisateur'];
			$d = $donneb['idutilisateur'];
		}
		$test = mysqli_query($bdd,"SELECT idtresor FROM tresor WHERE idutilisateur ='$d'");
		while ($donne = mysqli_fetch_assoc($test))
		{
			$donne['idtresor'];
			$c = $donne['idtresor'];
		}
		if ($c == null)
		{
			die();
		}
		if ($c == $perdu)
		{
			$fini = mysqli_query($bdd,"UPDATE tresor SET statutTresor = 'perdu' WHERE Idtresor ='$perdu'");
		}
		else
		{
		echo 	$erreur = "Le trésor n'est pas le votre";
		}

	}

?>


<h1>Chasse au trésor !</h1>

<br/>
<br/>

<br/>
<table align = right>
    <td>Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<td>
    <td><a href="logout.php">Déconnexion</a><td>
</table>
<br/>
<br/>
<br/>
<br/>
<form method="POST" action="">
<tr>
    <td>
    <label for ="recherche"> Recherche :</label>
</td>
<td>
    <input type="text" name = "recherche" placeholder ="Code, département; Ex : 37, Indre-et-Loire" id="recherche" size = "65">
</td>
<td>
    <input type="submit" name="formrecherche">
</td>
</tr>

<br/>
<br/>

<tr>
	<td>
    <label for ="recherche"> Remplacer des objets :</label>
</td>
<td>
	<input type="text" name = "recherchetrouve" placeholder ="insérer l'ID" id="recherche" size = "10">
</td>
<td>
	<input type="submit" name="formrecherchetrouve">
</td>
</tr>
<br/>
<br/>

<tr>
	<label for="perdu">Déclarer trésor perdu :</label>
<td>
	<input type="text" name="passerperdu" placeholder ="Insérer l'ID " id="passerperdu" size = "10">
	</td>
	<td>
	<input type="submit" name="formperdu">
	</td>
</tr>
</table>
<br/>
<br/>


<br/>
<br/>
 <fieldset name='Statistiques' class = 'meilleur'>
	<legend> Les aventuriers les plus actifs du mois !</legend>

	<?php
	while($donnees = mysqli_fetch_assoc($NbRecherche))
	{
		echo'Meilleur trouveur :',$donnees['pseudo'];
	}
?>

</br>

<?php
	while($donnees1 = mysqli_fetch_assoc($NbCache))
	{
		echo 'Meilleur cacheur :', $donnees1['pseudo'];
	}
?>

</br>

<?php
$nb = 0;
	while($donnees2 = mysqli_fetch_assoc($NbTrouve))
	{	
		$nb++;
	}
	echo 'Nombre de trésors trouvés : ', $nb;

?>

</fieldset>

</br>
</br>

<fieldset name='news'>
	<legend> Les nouveautés </legend>
    <?php
    	echo '<table border=1  class="nouveautés">';
    	echo "<tr><th>Nom du trésor</th><th>date d'ajout</th><th>Description</th><th>Lieu</th><tr>";
    	while($donnees3 = mysqli_fetch_assoc($Nouveau))
		{
			echo '<tr><td>',$donnees3['nomtresor'],'</td><td>',$donnees3['date'],'</td><td>',$donnees3['DescriptionBoite'],'</td><td>',$donnees3['Lieu'],'</td></tr>';
		}
		echo '</table>';
    ?>
</fieldset>

<br/>
<table class="fpage">
	<tr><td><input type= "submit" name="declarer" value= "Déclarer un trésor"></td><td><a href = 'liste.php'>Consulter la liste des trésors</a></td></tr>
</table>

<?php
				if(isset($erreur))
				{
					echo $erreur;
				}
				?>


</body>

</html>