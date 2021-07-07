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

?>
<html>
<head><title>Associa cliente</title></head>
<body>
<?php

// Verifica se ci sono dati POST
if(isset($_POST["cliente"]) && isset($_POST["utente"]))
{
	// Leggi dati
	$cliente = $_POST["cliente"];
	$username = $_POST["utente"];
	// Inseriamo menu
	$esito = mysqli_query($conn, "INSERT INTO cu VALUES('".$cliente."','".$username."')");
	if($esito)
	{
		echo "<p><b>Cliente associato!</b></p>";
	}
	else
	{
		echo "<p><b>Errore nell'associazione del cliente: ".mysqli_error($conn)."</b></p>";
	}
	
}

?>
<h2>Associa Cliente</h2>
<form name='associa_cliente_form' action='associa_cliente.php' method='post'>
Seleziona cliente:
<?php
// Leggi clienti
$result = mysqli_query($conn, "SELECT * FROM CLIENTE WHERE CODICE NOT IN(SELECT CLIENTE FROM cu)");
echo "<select name='cliente'>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<option value='".$row["CODICE"]."'>".$row["CODICE"]."</option>";	
}
echo "</select><br>";

?>

Seleziona utente:
<?php

// Leggi utenti
$result = mysqli_query($conn, "SELECT * FROM users WHERE username NOT IN(SELECT username FROM cu) and tipo=2");
echo "<select name='utente'>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
}
echo "</select><br>";

?>
<br>
<input type='submit'>
</form>
<p>
<a href='home_admin.php'>Torna alla home</a>
</p>
</body>
</html>