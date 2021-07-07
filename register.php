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
	$result = mysqli_query($conn, "INSERT INTO users VALUES (\"".$username."\", \"".$password."\", 2)");
     
	if($result)
	{
		echo "<p><b>UTENTE REGISTRATO!</b></p>";
		echo "<p><a href='login.php'>Torna al login</a></p>";
	}
	else
	{
		echo "<p><b>Errore nella registrazione: ".mysqli_error($conn)."</b></p>";
	}
}

?>