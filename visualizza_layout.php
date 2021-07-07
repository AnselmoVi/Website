<?php
// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != 1)
{
	die("Permesso negato");
}

// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

// Leggi layout
$result = mysqli_query($conn, "SELECT * FROM layout");
if(mysqli_num_rows($result) == 0)
{
	echo "Nessun layout&ugrave inserito";
}
else
{
	echo "<h1>Elenco layout&ugrave</h1>";
	echo "<table border='1'>";
	echo "<tr><th>Costo Totale</th><th>Partita Iva Sviluppatore</th></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<html>";
		echo "<head></head>";
		echo "<body>";
		echo "<tr><td>".$row["COSTO_TOTALE"]." €</td><td>".$row["SVILUPPATORE"]." </td></tr>";
		echo "</body>";
		echo "</html>";
	}
	echo "</table>";
}

?>

<html>
<body>
<p>
<a href='home_admin.php'>Torna alla home</a>
</body>
</html>