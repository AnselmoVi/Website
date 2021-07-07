<?php
// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != 3)
{
	die("Permesso negato");
}

// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

$username = $_SESSION["username"];

//Cerco lo sviluppatore
$sviluppatore = mysqli_query($conn, "SELECT PIVA FROM ANA_SVILUPPATORI AS A WHERE A.USERNAME = '".$username."'"); 
if($sviluppatore)
{
	echo "Sviluppatore trovato";
}
else
{
	echo "Sviluppatore non presente";
}

// Leggi i prodotti dello sviluppatore
$riga = mysqli_fetch_array($sviluppatore, MYSQLI_ASSOC);


$result = mysqli_query($conn, "SELECT CITTA,URL,DATA_PUBBLICAZIONE,CLIENTE FROM layout as L  join sito_web as S ON S.LAYOUT = L.ID  JOIN cliente as C ON S.CLIENTE = C.CODICE WHERE L.SVILUPPATORE=".$riga["PIVA"]."");


if(mysqli_num_rows($result) == 0)
{
	echo "Nessun sito web";
}
else
{
	echo "<h1>Elenco siti web</h1>";
	echo "<table border='1'>";
	echo "<tr><th>Citta</th><th>URL</th><th>DATA</th><th>Cliente</th></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<html>";
		echo "<head></head>";
		echo "<body>";
		echo "<tr><td>".$row["CITTA"]."</td><td>".$row["URL"]."</td><td>".$row["DATA_PUBBLICAZIONE"]."</td><td>".$row["CLIENTE"]."</td></tr>";
		echo "</body>";
		echo "</html>";
	}
	echo "</table>";
}

?>

<html>
<body>
<p>
<a href='home_sviluppatori.php'>Torna alla home</a>
</body>
</html>