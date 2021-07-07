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
<head><title>Inserisci layout</title></head>
<body>
<?php

// Verifica se ci sono dati POST
if(isset($_POST["id_sviluppatore"]) && isset($_POST["moduli"]))
{
	// Leggi dati
	$id_sviluppatore = $_POST["id_sviluppatore"];
	$moduli = $_POST["moduli"];
	
	// Leggiamo l'id del layout inserito
	$id_layout = mysqli_insert_id($conn);
	// Inseriamo tutte i moduli selezionati nel layout
	$somma=0;
	foreach($moduli as $id_modulo)
	{
		mysqli_query($conn, "INSERT INTO componente(ID_layout, id_modulo) VALUES('".$id_layout."', '".$id_modulo."')");
        $costop=mysqli_query($conn," SELECT COSTO from MODULO as M where M.ID='".$id_modulo."' "); 
				
        
		$riga = mysqli_fetch_array($costop, MYSQLI_ASSOC);     
foreach($riga as $id_riga){
	   if($somma==0)$somma=$id_riga;

      else $somma=$id_riga+$somma;
	
}		
      
      
     // if($somma==0)$somma=$forse;

      //else $somma=$forse+$somma;
              
	}
        
	echo "<p><b>Sito web inserito!</b></p>";



   mysqli_query($conn, "INSERT INTO layout(COSTO_TOTALE,SVILUPPATORE) VALUES('".$somma."','".$id_sviluppatore."')")or die(mysqli_error($conn));
	
}

?>
<h2>Nuovo layout</h2>
<form action='inserisci_layout.php' method='post'>
SVILUPPATORI 
<?php
$result = mysqli_query($conn, "SELECT * FROM SVILUPPATORE");
// TODO check esistono sviluppatori
echo "<select name='id_sviluppatore'>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<option value='".$row["PIVA"]."'>".$row["NOME"]."</option>";	
}
echo "</select><br>";

?>

Seleziona moduli:<br>
<?php

// Leggi moduli
$result = mysqli_query($conn, "SELECT * FROM modulo");
// TODO check esistono moduli
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	echo "<input type='checkbox' name='moduli[]' value='".$row["ID"]."'> ".$row["NOME"]."<br>";
}

?>
<input type='submit'>
</form>
<p>
<a href='home_admin.php'>Torna alla home</a>
</body>
</html>