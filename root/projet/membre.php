<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
	header ('Location:index.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf8">
	<title>Espace membre</title>
</head>

<body>
	<p>
	Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !
	</p>
	<a href="logout.php">Déconnexion</a>
</body>
</html>
