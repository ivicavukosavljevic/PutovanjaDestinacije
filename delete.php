<?php

// Preuzimanje promenljive iz QUERY STRINGA
$id = $_POST['id'];

// Konektovanje na bazu sa proverom ispravnosti
$con = mysql_connect('localhost','root','');
/* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
if (!$con) {
    exit('Povezivanje nije uspelo: ' . mysql_error());
}

// Selektovanje baze
mysql_select_db("dbputovanja", $con);

// Izvrsenje upita. Obratite paznju da se koriste dvostruki navodnici
// da bi se izvrsilo razvijanje promenljive $id
mysql_query("DELETE FROM destinacije WHERE IDDestinacije = $id");

// Slanje korisnika na destinacije.php stranicu
header('Location: destinacije.php');

?>