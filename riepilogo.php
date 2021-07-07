<?php

// Avvia la sessione
session_start();

// Controlla ruolo
if($_SESSION["type"] != 1)
{
	die("Permesso negato");
}

?>
<html>
<head><title>Riepilogo</title></head>
<body>
<p>
Scegli un'operazione:<br>
<ul>
<li><a href='AjaxSelectDatatableSite.html'>Cerca siti tramite cliente</a></li>
<li><a href='AjaxSelectDatatableLayout.html'>Cerca layout tramite sviluppatore</a></li>
<li><a href='AjaxSelectDatatableModuli.html'>Cerca moduli tramite layout</a></li>
</ul>
</p>
<br>
<p>
<a href='home_admin.php'>Torna indietro</a>
</p>
<p>
<a href='logout.php'>Logout</a>
</p>
</body>
</html>