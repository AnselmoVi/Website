<?php

// Avvia la sessione
session_start();


if($_SESSION["type"] != 1)
{
	die("Permesso negato");
}
// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

 
$result = mysqli_query($conn, "SELECT * FROM modulo");
 
$num_rows = mysqli_num_rows($result);
  
$res = array();

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   $res[] = array(
	  'ID' => $row['ID'],
      'NOME' => $row['NOME'],
	  'FUNZIONE' => $row['FUNZIONE'],
	  'COSTO' => $row['COSTO'],
   );
}

$json_data = array(
                "draw"            => 1,
                "recordsTotal"    => $num_rows,
                "recordsFiltered" => $num_rows,
                "data"            => $res
            );
$json = json_encode($json_data);
echo $json;
?>