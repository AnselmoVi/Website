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
<head><title>Inserisci cliente</title></head>
<body>
<?php

// Verifica se ci sono dati POST
if(isset($_POST["citta"]) && isset($_POST["indirizzo"]) && isset($_POST["telefono"]))
{
	// Leggi dati
	$citta = $_POST["citta"];
	$ind = $_POST["indirizzo"];
	$tel = $_POST["telefono"];
	// Inserisci cliente
	$esito = mysqli_query($conn, "INSERT INTO CLIENTE VALUES(0, '".$citta."', '".$ind."', '".$tel."',0,0)");
	if($esito)
	{
		echo "<p><b>Cliente inserito!</b></p>";
	}
	else
	{
		echo "<p><b>Errore nell'inserimento del cliente: ".mysqli_error($conn)."</b></p>";
	}
}

?>

<h2>Nuovo cliente</h2>
<script type='text/javascript'>
function checkForm()
{
	// Controlla che partita codice, citta, indirizzo e telefono non siano vuoti
	if(document.cliente_form.citta.value == '' ||
	   document.cliente_form.indirizzo.value == '' ||
	   document.cliente_form.telefono.value == '')
	{
		alert('Inserire citta, indirizzo e telefono!');
		return false;
	}
	// Se arriviamo qui, tutto ok
	return true;
}
</script>
<form name='cliente_form' action='inserisci_cliente.php' method='post' onsubmit='return checkForm()'>
Citta <input type='text' name='citta'><br>
Indirizzo <input type='text' name='indirizzo'><br>
Telefono <input type='text' name='telefono'><br>
<input type='submit'>
</form>
<p>
<a href='home_admin.php'>Torna alla home</a>
</p>
</body>
</html>