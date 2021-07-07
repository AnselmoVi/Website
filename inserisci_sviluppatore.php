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
<head><title>Inserisci Sviluppatore</title></head>
<body>
<?php

if(isset($_POST["piva"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["telefono"]) )
// Verifica se ci sono dati POST
{
	// Leggi dati
	$piva = $_POST["piva"];
	$nome = $_POST["nome"];
	$cognome = $_POST["cognome" ];
	$telefono = $_POST["telefono"];
	
	// Inserisci Sviluppatore
	$esito = mysqli_query($conn, "INSERT INTO Sviluppatore VALUES(\"".$piva."\", \"".$nome."\", \"".$cognome."\", \"".$telefono."\")");
	if($esito)
	{
		echo "<p><b>Sviluppatore inserito!</b></p>";
	}
	else
	{
		echo "<p><b>Errore nell'inserimento dello Sviluppatore: ".mysqli_error($conn)."</b></p>";
	}
}

?>
<h2>Elenco sviluppatori</h2>
<?php

// Leggi sviluppatori
$result = mysqli_query($conn, "SELECT * FROM Sviluppatore");
if(mysqli_num_rows($result) == 0)
{
	echo "Nessun Sviluppatore inserito";
}
else
{
	echo "<table border='1'>";
	echo "<tr><th>Partita Iva</th><th>Nome</th> <th>Cognome</th><th>telefono</th></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<tr><td>".$row["PIVA"]."</td><td>".$row["NOME"]."</td><td>".$row["COGNOME"]."</td><td>".$row["TELEFONO"]."</td></tr>";
	}
	echo "</table>";
}

?>
<h2>Nuovo Sviluppatore</h2>
<script type='text/javascript'>
function checkForm()
{
	// Controlla che partita iva, nome cognome e telefono non siano vuoti
	if(document.Sviluppatore_form.piva.value == '' ||
	   document.Sviluppatore_form.nome.value == '' ||
	   document.Sviluppatore_form.cognome.value == '' ||
	   document.Sviluppatore_form.telefono.value == '')
	{
		alert('Inserire partita iva, nome cognome e indirizzo');
		return false;
	}
	// Se arriviamo qui, tutto ok
	return true;
}
</script>
<form name='Sviluppatore_form' action='inserisci_Sviluppatore.php' method='post' onsubmit='return checkForm()'>
Partita Iva <input type='text' name='piva'><br>
Nome Sviluppatore <input type='text' name='nome'><br>
Cognome <input type='text' name='cognome'><br>
Telefono <input type='text' name='telefono'><br>
<input type='submit'>
</form>
<p>
<a href='home_admin.php'>Torna alla home</a>
</body>
</html>