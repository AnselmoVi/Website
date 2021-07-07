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
<head><title>Associa Sviluppatore</title></head>
<body>
<?php

// Verifica se ci sono dati POST
if(isset($_POST["ristorante"]) && isset($_POST["utente"]))
{
	// Leggi dati
	$sviluppatore = $_POST["sviluppatore"];
	$username = $_POST["utente"];
	// Inseriamo layout
	$esito = mysqli_query($conn, "INSERT INTO anagrafica_ristoranti VALUES('".$username."', '".$ristorante."')");
	if($esito)
	{
		echo "<p><b>Ristorante associato!</b></p>";
	}
	else
	{
		echo "<p><b>Errore nell'associazione del ristorante: ".mysqli_error($conn)."</b></p>";
	}
	
}

?>
<h2>Associa Ristorante</h2>
<form name='associa_ristorante_form' action='associa_ristorante.php' method='post'>
Seleziona ristorante:
<?php
// Leggi ristoranti
$result = mysqli_query($conn, "SELECT * FROM ristorante WHERE piva not IN(SELECT ristorante FROM anagrafica_ristoranti)");
echo "<select name='ristorante'>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<option value='".$row["PIVA"]."'>".$row["NOME"]."</option>";	
}
echo "</select><br>";

?>

Seleziona utente:
<?php

// Leggi utenti
$result = mysqli_query($conn, "SELECT * FROM users WHERE username NOT IN(SELECT username FROM anagrafica_clienti) and tipo=3");
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