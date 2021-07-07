<?php

// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != 3)
{
	die("Permesso negato");
}

?>
<html>
<head><title>Amministrazione prodotti</title></head>
<body>
<h2>Benvenuto <?php echo $_SESSION["username"]; ?>!</h2>
<p>
Scegli un'operazione:<br>
<ul>
<li><a href='visualizza_prodotti.php'>Prodotti venduti</a></li>
</ul>
</p>
<br>
<p>
<a href='logout.php'>Logout</a>
</body>
</html>