<?php

//inc.php
//Lepiej tu nie rób zmian. Chyba że się narpawdę znasz.
//Copyright Fszeker 2012
 
 
 //Funkcja na łączenie z MySQL
 function connectMySQL() {
 
  require('config.php');
  mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die('<br /><strong>Błąd łączenia z bazą danych:</strong> ' . mysql_error());
  mysql_select_db($mysql_db) or die('<br /><strong>Błąd wybierania bazy danych:</strong> ' . mysql_error());
 
 }
 
 $script_version = '0.4.3';
 $last_update = '10.11.2012';

?>
