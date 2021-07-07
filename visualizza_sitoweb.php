<?php
// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != 2)
{
	die("Permesso negato");
}

// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

$username = $_SESSION["username"];

//Cerco il cliente
$cliente = mysqli_query($conn, "SELECT CODICE FROM ANAGRAFICA AS A WHERE A.USERNAME = '".$username."'"); 
if($cliente)
{
	echo "Cliente trovato";
}
else
{
	echo "Cliente non presente";
}

// Leggi i siti del cliente
$riga = mysqli_fetch_array($cliente, MYSQLI_ASSOC);
$FORSE=$riga["CODICE"];
$result = mysqli_query($conn, "SELECT * FROM sito_web as s where s.CLIENTE='".$FORSE."' ");
if(mysqli_num_rows($result) == 0)
{
	echo "Nessun sito web";
}
else
{
	echo "<h1>Elenco siti web</h1>";
	echo "<table border='1'>";
	echo "<tr><th>Codice</th><th>URL</th><th>DATA</th><th>Cliente</th><th>Layout</th></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<html>";
		echo "<head></head>";
		echo "<body>";
		echo "<tr><td>".$row["CODICE"]."</td><td>".$row["URL"]."</td><td>".$row["DATA_PUBBLICAZIONE"]."</td><td>".$row["CLIENTE"]."</td><td>".$row["LAYOUT"]." </td></tr>";
		echo "</body>";
		echo "</html>";
	}
	echo "</table>";
}

?>

<html>
<body>
<p>
<a href='home_cliente.php'>Torna alla home</a>
</body>
</html>