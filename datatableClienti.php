<?php

// Avvia la sessione


// Controlla ruolo
if($_SESSION["type"] != 1)
{
	die("Permesso negato");
}

$db_host = "151.97.9.185:3307";
$db_user = "viola_anselmo";
$db_password = "6610862863";
$db_database = "viola_anselmo";

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

 
$result = mysqli_query($conn, "SELECT * FROM CLIENTI");
 
$num_rows = mysqli_num_rows($result);
  
$res = array();

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   $res[] = array(
	  'CODICE'=> $row['CODICE'],
          'CITTA' => $row['CITTA'],
	  'INDIRIZZO'=>$row['INDIRIZZO'],
	  'TELEFONO'=> $row['TELEFONO'],
          'N_SITI' => $row['N_SITI'],
	  'SPESA_TOTALE'=>$row['SPESA_TOTALE'],
	  
	  'button'=>''
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