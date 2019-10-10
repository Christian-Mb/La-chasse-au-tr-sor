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

    .desc{
        border-radius: 10px;
        padding:16px;
        color: white;
        background-color:rgb(140,100,190);
    }
    fieldset{
        border-radius: 10px;
        padding:16px;
        color: white;
        background-color:rgb(153,122,141);
        margin:10px;
    }

    legend{
        margin-bottom:0px;
        margin-left:16px;
    }

    .connection{
        background-color: rgb(153,122,141);
    }

    .meilleur{
        margin-right: 400px;
        margin-left: 400px;
    }

    .nouveautés{
        border-collapse: collapse;
        width: 90%;
        margin:auto;
    }

    .fpage{
        margin: auto;
    }
    
    .droite{
        float: right;
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


<title>Accueil</title>

</head>

<body>

<h1>Chasse au trésor !</h1>



<form action="" method="post">

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

if (isset($_POST['formconnexion']))
{
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
    {
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        $test = 'SELECT password FROM utilisateur WHERE pseudo="'.
            $bdd->real_escape_string($pseudo).'";';

        $res = $bdd->query($test);
        $row = $res->fetch_assoc();

        $salt = '$2x$14$df5hkt7edlkWz57fgmpqv9$';
        if ( ( $res->num_rows==1 ) && ( crypt( $mdp, $salt ) == $row['password'] ) )
        {
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            header('Location:accueilCO.php');
            die();
        }
        else
        {
            $erreur ="Le pseudo ou le mot de passe est incorrect";
        }

    }
}
else
{
    $erreur = "Veuillez remplir tous les champs";
}

?>
<br/>
<br/>
<br/>

<div class="droite">
<fieldset class='CO'>
<table align = righ class="connection">
    <tr>
     <td>
          <label for="pseudo"> Pseudo :</label>
     </td>
     <td>
          <input type="text" name = "pseudo" placeholder ="Saisir votre pseudo"  value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>">
      </td>
     </tr>
     <tr>
     <td>
           <label for="password">Mot de passe :</label>
     </td>
     <td>
        <input type="password" name ="mdp" placeholder="Saisir votre mot de passe" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>">
     </td>
      </tr>

    <td><a href='projet.php'>inscription</a><td>
     <input type="submit" name="formconnexion">
     <?php
          if(isset($erreur))
          {
              echo $erreur;
          }

?>
</table>
</fieldset>
</div>

<br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

<fieldset class="desc">
<p>
    Bienvenue sur le site de chasse au trésor!
</p>
<p>
    Ici, votre instinct d'aventurier se réveille à la vue de tant de trésors et d'endroits à découvrir! Notre site vous permet en effet de partir à leur recherche que d'autres utilisateurs ont caché partout en France.
</p>
<p>
    Vous pouvez soit partir à l'aventure, soit être la personne qui créée cette aventure en faisant vos propres énigmes que les autres parviennes à VOTRE trésor!
</p>
</fieldset>
<?php


//selectionne le pseudo de l'utilisateur qui a trouvé le plus de trésors ce mois-ci.
$NbRecherche = mysqli_query($bdd, 'SELECT pseudo from utilisateur where idutilisateur= (select idutilisateur from statistique where NbRechercher= (select max(nbRechercher) from statistique) LIMIT 1)');

//selectionne le pseudo de l'utilisateur qui a caché le plus d'élements ce mois-ci.
$NbCache = mysqli_query($bdd, 'SELECT pseudo from utilisateur where idutilisateur= (select idutilisateur from tresor where nbCacher= (select max(nbCacher) from tresor) LIMIT 1)');


$NbTrouve = mysqli_query($bdd, "SELECT statutTresor, date from tresor where statutTresor= ('trouver') AND MONTH(date) = (SELECT MONTH(NOW())) AND YEAR(date) = (SELECT YEAR(NOW()))");

$Nouveau = mysqli_query($bdd, "SELECT nomtresor, date, DescriptionBoite, Lieu FROM tresor WHERE statutTresor= ('cacher') ORDER BY `tresor`.`date` DESC LIMIT 5");
?>

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
    	echo '<table border=1 class="nouveautés">';
    	echo "<tr><th>Nom du trésor</th><th>date d'ajout</th><th>Description</th><th>Lieu</th><tr>";
    	while($donnees3 = mysqli_fetch_assoc($Nouveau))
		{
			echo '<tr><td>',$donnees3['nomtresor'],'</td><td>',$donnees3['date'],'</td><td>',$donnees3['DescriptionBoite'],'</td><td>',$donnees3['Lieu'],'</td></tr>';
		}

    ?>
</fieldset>

</body>

</html>