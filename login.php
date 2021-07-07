<?php

// Includi dati DB
// Esporta $db_host, $db_user, $db_password, $db_database
include("db.php");
// Connessione al database
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

// Avvia sessione
session_start();

// Verifica se sono stati mandati dati
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	// Leggi dati
	$username = $_POST["username"];
	$password = $_POST["password"];
	// Cripta password
	$password = md5($password);
	// Cerca la coppia (username, password) nel database
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'");
	if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		// Utente trovato, leggi tipo
		$type = $row["type"];
		// Salva login in sessione
		$_SESSION["username"] = $username;
		$_SESSION["type"] = $type;
		// Ridireziona l'utente alla pagina specifica per il tipo
		if($type == 1)
		{
			// Redirect
			header("Location: home_admin.php");
		}
		else if($type == 2)
		{
			// Redirect
			header("Location: home_cliente.php");
		}
else if($type == 3)
		{
			// Redirect
			header("Location: home_sviluppatori.php");
		}
		else
		{
			die("Errore nel DB, tipo non valido");
		}
	}
	else
	{
		// Utente non trovato
		echo "<html>";
		echo "<head></head>";
		echo "<body>";
		echo "Login non valido<br>";
		echo "<a href='login.html'>Torna al login</a>";
		echo "</body>";
		echo "</html>";
		
	}
}

?>