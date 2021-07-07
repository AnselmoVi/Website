<?php
// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != "1")
{
	die("Permesso negato");
}

// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

$url = $_POST['url'];
$data = $_POST['data'];
$idSelectedUser = $_POST['idSelectedUser'];
$idSelectedLayout = $_POST['idSelectedLayout'];

if(isset($_POST['url']) && isset($_POST['data']) && isset($_POST['idSelectedUser']) && isset($_POST['idSelectedLayout'])){

$sql = "INSERT INTO sito_web(URL,DATA_PUBBLICAZIONE,CLIENTE,LAYOUT)
     VALUES('$url','$data','$idSelectedUser','$idSelectedLayout')";
	 
$result=mysqli_query($conn,$sql); 

if($result){
	echo "Sito inserito correttamente";
}else{
	echo "Inserimento fallito: Riempire tutti i campi";
}
}
?>