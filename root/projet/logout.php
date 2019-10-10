<?php
session_start();
session_unset();
session_destroy();
header('Location:accueil3.php');
exit();
?>
