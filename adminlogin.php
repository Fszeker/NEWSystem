<?php

/*
  Password protection system based on SESSION
  Fszeker 2012
*/
session_start();

if(isset($_SESSION['login'])) {

die ('<meta http-equiv="refresh" content="0; url=http://localhost/qx/admin.php" />');

}

	//only if index.php?login
	if(isset($_REQUEST['login'])) {
		
		include('inc.php');
		connectMySQl();
		
		$userinputed = $_POST['user'];
		$passinputed = md5($_POST['pass']);
		
		$result = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE user = '{$userinputed}' AND password = '{$passinputed}';"));
		
		if($passinputed == $result['password']) 
		{
		 
		 session_start();
		 $_SESSION['login'] = '1';
		 $_SESSION['userid'] = $result['id'];
		 die ('<meta http-equiv="refresh" content="0; url=http://localhost/qx/admin.php" />');
		 
		} else {
		
		 die ('<meta http-equiv="refresh" content="0; url=http://localhost/qx/adminlogin.php?wrong" />');
		
		}
		
	
	}

?>
<!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en"
       "http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Admin Login</title>
  <link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<!--- index.php --->
  <div class="ramka">
	
	<h1>Admin Login</h1>
	<?php if(isset($_REQUEST['wrong'])) { echo "<div class='error'>Wrong User/Password</div>"; };
		  if(isset($_REQUEST['loggedout'])) { echo "<b><font color='green' size='2'>Logged Out!</font></b><br />"; };?>
	<br />
	<form action='?login' method='POST'>
	<input type='text' class='input focusable b-autoheight' placeholder='Username' size="17" name='user' /><br />
	<input type='password' class='input focusable b-autoheight' placeholder='Password' size="17" name='pass' /><br />
	<input type='submit' value='Login' class="button login" />
	</form>

	
  </div>
  NEWSystem® All rights reserved. © 2012 by Fszeker
</body>
</html>