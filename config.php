<?php
/*
config.php
Plik konfiguracyjny
Skrypt WebBookCraft do Newsów. Copyright 2012 Fszeker
*/

//Ustawienia MySQL i pierwszrzędne ustawienia (przed instalacją)

//Adres strony z http:// na początku (bez slesza końcowego)
$adres = 'http://localhost/qx';

//Adres serwera. Zazwyczaj 'localhost'
$mysql_host = 'localhost';

//Nazwa użytkownika do MySQL.
$mysql_user = 'root';

//Hało do konta
$mysql_pass = 'haslo';

//Baza Danych w której mają być przechowywane tabele z newsami i użytkownikami (tabele zostaną utworzone)
$mysql_db = 'WebCraft';

//Koniec Ustawień MySQL


//OGÓLNE USTAWIENIA STRONY!
//TO MOŻESZ ZMIENIĆ PO INSTALACJI!

//Nazwa strony (Będzie jako logo i w belce na górze)
$site_name = '';

//Opis strony. Krótki opis jako Meta Description i 'sublogo'
$site_desc = '';

//Słowa kluczowe, tagi strony (ważne przy pozycjonowaniu w googlu)
$site_keywords = '';

//favicon - ikonka która jest przy stronie jak sie ją doda do zakładek. Musi być w formacie .ico najlepiej adres lokalny (ten sam serwer FTP) i najlepiej ten sam folder.
$site_favicon = '';


?>