<?php
	
//install.php
//Instalacja skryptu -> Tworzenie tabel w bazie.
//Copyright 2012 Fszeker
	
	//Ostrzeżenie!
	echo '<script language="javascript">alert("Pamiętaj! Najpierw skonfiguruj plik config.php!");</script>';
	
	//Polaczenie z MySQL. Zmiana Loginu, hasla, bazy, hosta w pliku config.php
	include("config.php");
	mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die('<br /><strong>Błąd łączenia z bazą danych:</strong> ' . mysql_error() . '<br /><strong>Sprawdż czy dobrze skonfigurowałeś config.php</strong>');
	mysql_select_db($mysql_db) or die('<br /><strong>Błąd wybierania bazy danych:</strong> ' . mysql_error() . '<br /><strong>Sprawdż czy dobrze skonfigurowałeś config.php</strong>');
 
 
 //Tworzenie tabeli 'news'
 mysql_query("
	CREATE TABLE  `{$mysql_db}`.`news` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`title` VARCHAR( 25 ) NOT NULL ,
	`summary` TEXT NOT NULL ,
	`text` TEXT NOT NULL ,
	`views` INT( 11 ) NOT NULL ,
	`date` DATETIME NOT NULL ,
	`users` INT( 11 ) NOT NULL
	) ENGINE = INNODB;")
 or die ('<strong>Błąd bazy MySQL:</strong> <em>' . mysql_error() . '</em>');
 
 
 //Tworzenie tabeli 'users'
 mysql_query("
	CREATE TABLE  `{$mysql_db}`.`users` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`name` VARCHAR( 25 ) NOT NULL
	) ENGINE = INNODB;")
 or die ('<strong>Błąd bazy MySQL:</strong> <em>' . mysql_error() . '</em>');

 //UDAŁO SIĘ POŁACZYĆ Z MYSQL I STWORZYĆ!
 echo '<strong>Udało się poprawnie dodać tabele do bazy :)</strong> Teraz możesz usunąć plik install.php. Pamiętaj że <u>config.php</u> musi mieć <u>CHMOD 666</u>';
 
?>