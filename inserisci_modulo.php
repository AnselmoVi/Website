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
<head><title>Inserisci modulo</title></head>
<body>
<?php

// Verifica se ci sono dati POST
if(isset($_POST["nome"]) && isset($_POST["funzione"]) && isset($_POST["costo"]))
{
	// Leggi dati
	$nome = $_POST["nome"];
	$funzione = $_POST["funzione"];
	$costo= $_POST["costo"];
	
		// Inserisci modulo
		$esito = mysqli_query($conn, "INSERT INTO modulo(NOME,FUNZIONE, COSTO) VALUES(\"".$nome."\", \"".$funzione."\" , \"".$costo."\")");
		if($esito)
		{
			echo "<p><b>modulo inserita!</b></p>";
		}
		else
		{
			echo "<p><b>Errore nell'inserimento della modulo: ".mysqli_error($conn)."</b></p>";
		}
	
	
}

?>
<h2>Elenco moduli</h2>
<?php

// Leggi moduli
$result = mysqli_query($conn, "SELECT * FROM modulo");
if(mysqli_num_rows($result) == 0)
{
	echo "Nessun modulo inserito";
}
else
{
	echo "<table border='1'>";
	echo "<tr><th>Nome</th><th>Funzione</th><th>Costo</th></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<tr><td>".$row["NOME"]."</td><td>".$row["FUNZIONE"]."</td><td>".$row["COSTO"]." €</td></tr>";
	}
	echo "</table>";
}

?>
<h2>Nuova modulo</h2>
<script type='text/javascript'>
function checkForm()
{
	// Controlla che nome,funzione e costo non siano vuoti
	if(document.modulo_form.nome.value == '' || document.modulo_form.funzione.value == '' ||
	   document.modulo_form.costo.value == '')
	{
		alert('Inserire nome, funzione ecosto');
		return false;
	}
	// Se arriviamo qui, tutto ok
	return true;
}
</script>
<form name='modulo_form' action='inserisci_modulo.php' method='post' onsubmit='return checkForm()'>
Nome modulo <input type='text' name='nome'><br>
Funzione <input type='text' name='funzione'><br>
Costo <input type='text' name='costo'><br>
<input type='submit'>
</form>
<p>
<a href='home_admin.php'>Torna alla home</a>
</body>
</html>