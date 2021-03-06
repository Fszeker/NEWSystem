<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<?php

//index.php
//Główna strona. Główne skrypty.
//Copyright 2012 Fszeker

?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Serwer qx</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="crafty.css">
  <link rel="canonical" href=""><!-- http://goo.gl/wKFDI -->
  <link rel=icon href="favicon.ico">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js"></script>
</head>
<body>
<!--[if IE]><div class="ie"><![endif]-->
<div id="wrapper">
  <header class="clearfix container">
    <hgroup>
      <h1><a href="index.html">qx</a></h1>
      <h2>Mniej lub bardziej prywatny serwer Fszekera i Lorda</h2>
    </hgroup>
    <nav role="navigation">
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Do Pobrania</a></li>
        <li><a href="#">Info o Servie</a></li>
        <li><a href="#">Mapka</a></li>
        <li><a href="#">Dołącz!</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
  <aside role="complimentary" id="complimentary">
      <div class="widget" id="search">
        <div class="widget-content">
          <form class="clearfix"><input type="search" placeholder="Szukaj"><input class="searchbtn" type="submit" value="Search"></form>
        </div>
      </div>
      <div class="widget" id="status">
        <h4 class="widget-title">Status servera</h4>
        <div class="widget-content">
          <h5 class="online">online</h5>
          <p>fake.</p>
        </div>
      </div>
	  <div class="widget">
         <h4 class="widget-title">Example Widget</h4>
         <div class="widget-content">
           <p>I tried to make this extremely flexible and simple at the same time, what you're looking at is the minimum required for a widget.</p>
         </div>
      </div>
      <div class="widget">
        <h4 class="widget-title">Updating</h4>
        <div class="widget-content">
          <p>Most updates to this template will be CSS based, simply replace your old CSS. Sometimes there may be other resources too such as fonts or images; update those too.</p>
        </div>
      </div>
      <div class="widget">
        <h4 class="widget-title">Example Menu</h4>
        <div class="widget-content">
          <ul>
            <li><a href="#">Link 01</a></li>
            <li><a href="#">Another one</a></li>
            <li><a href="#">The third</a>
              <ul>
                <li><a href="#">Sub Item</a></li>
                <li><a href="#">Sub Item</a></li>
                <li><a href="#">Sub Item</a></li>
              </ul>
            </li>
            <li><a href="#">Lastly</a></li>
          </ul>
        </div>
      </div>
      <div class="widget" id="news">
        <h4 class="widget-title">Recent News</h4>
        <div class="widget-content">
          <ul>
            <li>
              <a href="#" class="item-title">New Server up and running!</a>
              <div class="item-pubdate">19 May 2012</div>
            </li>
            <li>
              <a href="#" class="item-title">Order up one extra long news item that spans multiple lines.</a>
              <div class="item-pubdate">30 April 2012</div>
            </li>
            <li>
              <a href="#" class="item-title">Welcome to this website</a>
              <div class="item-pubdate">21 March 2012</div>
            </li>
          </ul>
        </div>
      </div> END OF WIDGET-->
  </aside>
  <div id="content-before"><!-- PUSTE --></div>
  <div role="main" id="main">
    <?php
	
	//Polaczenie z MySQL. Zmiana Loginu, hasla, bazy, hosta w pliku config.php
	include("config.php");
  mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die('<br /><strong>Błąd łączenia z bazą danych:</strong> ' . mysql_error());
  mysql_select_db($mysql_db) or die('<br /><strong>Błąd wybierania bazy danych:</strong> ' . mysql_error());

	
	//Czytanie artykułów z Bazy weług ID i przypisywanie do zmiennej
	$query = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());
	
	//Wyświetlanie newsa (rekurencja na ilośc newsów)
	while($row = mysql_fetch_array($query)) {
	 
	 
	 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".$row['users']."'"));
	 $author = $user['user'];
	
	 echo '<article>';
	 echo '<h2>' . $row['title'] . '</h2><br />';
	 echo '<p>' . nl2br($row['summary']) . '</p></br />';
	 echo '<a href="czytaj.php?id=' . $row['id'] . '" class="button">Czytaj Dalej...</a>';
	 echo '<br />';
	 echo '<font size="2"><em> Dodał: <strong>' . $author . '</strong></em></font><br />';
	 echo '<font size="2"><em> Dodano: <strong>' . $row['date'] . '</strong></em></font><br />';
	 echo '<font size="2"><em> Wyświetleń <strong>' . $row['views'] . '</strong></em></font><br />';
	 echo '</article>';
	 
	 }
	 
	 ?>
  </div><
  <div id="content-after"><!-- PUSTE --></div>
  </div>
  <footer>
    <p>Template stworzony przez: <a href="http://d3x.co" target="_blank">D3X Solutions</a>/ Licencja: <a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GNU GPL 2</a>.</p>
  </footer>
</div><!-- #wrapper -->

<!--[if IE]></div><![endif]-->
  <!--Place your JavaScript down here-->
  <script src="js/fontloader.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>
</html>