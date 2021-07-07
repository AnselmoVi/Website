 <?php

// Avvia la sessione
session_start();



// Include dati DB
include("db.php");

// Crea connessione al DB
$conn = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($conn, $db_database);

$result = mysqli_query($conn, "SELECT Distinct ID_LAYOUT FROM componente"); 
 
$res = array();
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   $res[] = array(
	  'ID_LAYOUT' => $row['ID_LAYOUT'],
       
   );
}
$json = json_encode($res);
echo $json;
?>