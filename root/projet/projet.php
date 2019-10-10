<?php

$bd = new mysqli("localhost","root", "usbw", "projet2", "3307");
if (isset($_POST['forminscription']))
{
		if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty ($_POST['mail']) AND !empty ($_POST['mdp2']))
		{
			$pseudo = $_POST['pseudo'];
			$mail = $_POST['mail'];
			$mdp = $_POST['mdp'];
			$mdp2 = $_POST['mdp2'];

			if($mdp != $mdp2)
			{
				$erreur = "Vos mots de passes ne correspondent pas";
			}
			else
			{	
				$salt = '$2x$14$df5hkt7edlkWz57fgmpqv9$';
				$password = crypt($_POST['mdp'], $salt);
				$sql = 'SELECT count(*) as num FROM utilisateur WHERE pseudo="'.
				$bd->real_escape_string($pseudo).'";';
				$res = $bd->query($sql);
				$row = $res->fetch_assoc();
				$numrecord = $row['num'];
				
				if ( $numrecord  == 0 ) {
			
					// préparation de la requete
					$sql = "INSERT INTO utilisateur (pseudo,email, password) VALUES('$pseudo','$mail','$password')";
					// exécution
					$bd->query($sql);
					session_start();
					$_SESSION['pseudo'] = $_POST['pseudo'];
					header('Location:accueilCO.php');
					die();
				}
				else {
					$erreur = 'Un membre possede deja ce pseudo';

				}
			}
		}
		else
		{
			$erreur = "Veuillez remplir tous les champs";
		}
	}

?>
<html>
<head>

<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: lightblue;
        background-image: url("champ.jpg");
    }

    h2{
        color: white;
        text-align: center;
    }

    fieldset{
        border-radius: 10px;
        padding:16px;
        color: white;
        background-color:rgb(153,122,141);
    }
</style>

<title>Inscription</title>
</head>
<body>
	<div align ="center">
		<h2>Inscription</h2>
		<br /><br />
		<form method="POST" action="">
			<fieldset name="Inscription" style="width:360px;"> 
				<legend> Inscription </legend>
					<table>
						<tr>
							<td>
							<label for="pseudo"> Pseudo :</label>
						</td>
							<td>
								<input type="text" name = "pseudo" placeholder ="Saisir votre pseudo" id="pseudo" title = "3 caracteres de chiffres et lettres minimum">
							</td>
						</tr>
						<tr>
							<td>
								<label for="password">Mot de passe :</label>
							</td>
							<td>
								<input id="password" type="password" title="5 caracteres minimum,chiffres ou lettres" name ="mdp" placeholder="Saisir votre mot de passe" >
							</td>
						</tr>
						<tr>
							<td>
								<label for="password2">Mot de passe :</label>
							</td>
							<td>
								<input id="password2" type="password" title="5 caracteres minimum,chiffres ou lettres" name ="mdp2" placeholder="Saisir votre mot de passe" >
							</td>
						</tr>
						<tr>
							<td>
								<label for="mail">Votre Mail :</label>
							</td>
							<td>
								<input id="mail" type="email" placeholder="Saisir votre email" name = "mail" >
							</td>
						</tr>
						<br />
					</table>
						<input type="submit" name="forminscription">
				</fieldset>
				<?php
				if(isset($erreur))
				{
					echo $erreur;
				}
				?>
		</form>
</body>
</html>
	