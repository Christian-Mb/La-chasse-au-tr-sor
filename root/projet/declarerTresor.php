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


<title>Déclarer un trésor</title>

</head>

<body>
<?php
session_start();
$bdd = new mysqli("localhost","root","usbw","projet2", "3307");
$pseudo = $_SESSION['pseudo'];
$id = mysqli_query($bdd,"SELECT idutilisateur FROM utilisateur WHERE '$pseudo' = pseudo");
while ($donne = mysqli_fetch_assoc($id))
{
	$donne['idutilisateur'];
	$a = $donne['idutilisateur'];
}


if (isset($_POST['formconnexion']))
{
	if(!empty($_POST['inventaire']) AND !empty($_POST['énigme']) AND !empty($_POST['descriptif']) AND !empty($_POST['date']) AND !empty($_POST['département']) AND !empty($_POST['titre']) AND !empty($_POST['difficulté1']))
	{
		$titre = $_POST['titre'];
		$inventaire = $_POST['inventaire'];
		$inventaire1 = $_POST['inventaire1'];
		$inventaire2 = $_POST['inventaire2'];
		$enigme = $_POST['énigme'];
		$descriptif = $_POST['descriptif'];
		$date = $_POST['date'];
		$departement = $_POST['département'];
		$photo = $_POST['fichier'];
		$difficulte = $_POST['difficulté1'];
		$sql2 = mysqli_query($bdd,"SELECT max(nbCacher) FROM tresor WHERE '$a' = idutilisateur");
		while ($donne2 = mysqli_fetch_assoc($sql2))
		{
			$donne2['max(nbCacher)'];
			$num = $donne2['max(nbCacher)'];
		}
		$num = $num + 1;

		$sql = "INSERT INTO tresor (nomtresor,DescriptionBoite,Lieu,idutilisateur,objet1,objet2,objet3,nbCacher,date,photo) VALUES('$titre','$descriptif','$departement','$a','$inventaire','$inventaire1','$inventaire2','$num','$date','$photo')";
		$bdd->query($sql);

		$idtres = mysqli_query($bdd,"SELECT max(idtresor) FROM tresor");
		while ($donne1 = mysqli_fetch_assoc($idtres))
		{
			$donne1['max(idtresor)'];
			$b = $donne1['max(idtresor)'];
		}
		$sql3 = "INSERT INTO enigme (enigme,niveau,idtresor) VALUES('$enigme','$difficulte', '$b')";
		$bdd->query($sql3);
		echo $erreur = "Votre trésor à été ajouté avec succès";


	}
	else
	{
		echo $erreur = "Veuiller remplir tous les champs!!!";
	}
}
?>
<h1>Chasse au trésor !</h1>

<br/>

<form method="POST" action="">

<fieldset name="DéclarationTrésor" style="width:400px;margin-left: auto;
margin-right: auto;">
<legend>  Déclaration d'un trésor  </legend>

<br/>

<label for="titre">Nom du trésor : </label>

<input type = "texte"
	
	name = "titre"
	size = "10"
	id = "titre" >

<br/>
<br/>

<label for="inventaire">Objet 1 : </label>

<input type = "text"
	
	name = "inventaire"
	size = "10"
	id = "inventaire" >
<br/>
<br/>

<label for="inventaire1">Objet 2 : </label>

<input type = "text"
	
	name = "inventaire1"
	size = "10"
	id = "inventaire1" >

<br/>
<br/>


<label for="inventaire1">Objet 2 : </label>

<input type = "text"
	
	name = "inventaire2"
	size = "10"
	id = "inventaire2" >

<br/>
<br/>

<label for="énigme"> énigme : </label>
<textarea cols = "80"
	rows = "4"
	maxlength = "300"
	name = "énigme"
	id = "énigme" >
</textarea>

<br/>
<label for="difficulté"> Selectionner la difficulté de l'énigme : </label>
<input type="radio" name="difficulté1" value="1">1
<input type="radio" name="difficulté1" value="2">2
<input type="radio" name="difficulté1" value="3">3


		<br/>
<br/>


<label for="descriptif"> descriptif : </label>
<textarea cols = "80"
	rows = "4"
	maxlength = "300"
	name = "descriptif"
	id = "descriptif"
	placeholder = "descriptif rapide de la boîte cachée (dimensions, matière)" >
</textarea>

<br/>
<br/>


<label for="dateCache"> Date de cache de l'objet : </label>
<input type = "date"
	name = "date"
	title = "Date de cache"
	id = "date" >

<br/>
<br/>


<label for="département">Nom du département où se situe le trésor : </label>

<input type = "text"
	name = "département"
	placeholder = "Saisir le nom du département"
	size = "30"
	id = "département" />
<br/>
<br/>


<label for="photo"> Ajouter une photo(facultatif) : </label>
<input type="file"
	name = "fichier"
	id = "fichier">
<br/>
<br/>

<p><input type="submit" name="formconnexion" class='input'></p>
</fieldset>

<p><a href='accueilCO.php'>Revenir à l'accueil</a></p>

<?php
if(isset($erreur))
{
	echo $erreur;
}
?>
</body>

</html>