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
<head><title>Amministrazione</title></head>
<body>
<h2>Benvenuto <?php echo $_SESSION["username"]; ?>!</h2>
<p>
Scegli un'operazione:<br>
<ul>
<li><a href='inserisci_sviluppatore.php'>Inserisci sviluppatore</a></li>

<li><a href='inserisci_modulo.php'>Inserisci moduli</a></li>
<li><a href='visualizza_moduli.php'>Visualizza moduli</a></li>
<li><a href='inserisci_layout.php'>Inserisci layout</a></li>

<li><a href='inserisci_cliente.php'>Inserisci cliente</a></li>
<li><a href='gestione_clienti.html'>Gestione clienti</a></li>
<li><a href='riepilogo.php'>Riepilogo</a></li>
<li><a href='datatableSviluppatore.html'>Visualizza sviluppatori</a></li>
<li><a href='datatableLayout.html'>Visualizza layout</a></li>
</ul>
</p>
</ul>
</p>
<br>
<p>
<a href='logout.php'>Logout</a>
</body>
</html>
