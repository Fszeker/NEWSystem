<?php

session_start();

if(!isset($_SESSION['login'])) {

die("<meta http-equiv='REFRESH' content='0; url=http://localhost/qx/adminlogin.php'>");

}

if(isset($_REQUEST['logoff'])) {

session_destroy();
die ('<meta http-equiv="refresh" content="0; url=http://localhost/qx/adminlogin.php?loggedout" />');

}

include('inc.php');
connectMySQL();
$userID = $_SESSION['userid'];
$sql_qur = mysql_query("SELECT * FROM users WHERE id = '$userID';") or die(mysql_error());
$userlogged = mysql_fetch_array($sql_qur);

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250" />
  <title>Admin Panel</title>
  <link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<!--- admin.php --->
  <div class="ramka">
	
	<h1 class="logged">Admin Panel</h1>
	<table width="100%"><tr><td width="33%">&nbsp; &nbsp;</td><td width="33%"><p style="margin-bottom: 10px;">Logged in as: <b><?php echo $userlogged['user']; ?></b></p></td><td width="33%"><form action="?logoff" method="post"><input type="submit" class="button" value="LOGOUT" /></form></td></tr></table>
	<br />
	<center><table>
		<tr>
		<td><a href="?" class="button home"><img src="./img/home.png" height="70%" width="70%" style="margin-left:2px;" /></a></td>
		<td><a href="?addnews" class="button" <?php if(isset($_REQUEST['addnews'])) { echo 'style="text-color:solid silver;"'; }?> >Add news</a></td>
		<td><a href="?managenews" class="button" <?php if(isset($_REQUEST['managenews'])) { echo 'style="text-color:solid silver;"'; }?> >Manage News</a></td>
		<td><a href="?adduser" class="button" <?php if(isset($_REQUEST['adduser'])) { echo 'style="text-color:solid silver;"'; }?> >Add User</a></td>
		<td><a href="?manageusers" class="button" <?php if(isset($_REQUEST['manageusers'])) { echo 'style="text-color:solid silver;"'; }?> >Manage Users</a></td>
		<td><a href="?info" class="button" <?php if(isset($_REQUEST['info'])) { echo 'style="text-color:solid silver;"'; }?> >Script Info</a></td>
		</tr>
	</table></center><br />
	<?php
	
	$sql_newses = mysql_query("SELECT * FROM news");
	$newses = mysql_num_rows($sql_newses);
	
	$sql_users = mysql_query("SELECT * FROM users");
	$users_num = mysql_num_rows($sql_users);
	
	if(isset($_REQUEST['addnews'])) {
	//echo '<option value="'.$value.'" '.(($value=='United States')?'selected="selected"':"").'>'.$value.'</option>';
	
	echo '
	<form action="?newsadded" class="form" method="POST">

	<p class="name">
		<input class="input2" type="text" name="title" id="name" placeholder="Title" />
	</p>

	<p class="text">
		<textarea class="textarea2" name="summary" placeholder="Type in Summary here..."></textarea><br />
		<font size="2" color="grey">If empty, text will become summary</font><br />
	</p>

	<p class="text">
		<textarea class="textarea2" name="text" placeholder="Type in news text here..." ></textarea><br />
		<font size="2" color="grey">HTML is <b>ON</b><br />Auto line-break is <b>ON</b><br /></font><br />
	</p>

	<p class="submit">
		<input type="submit" class="button" value="Send news" />
	</p>

	</form>
	';
	
	} elseif(isset($_REQUEST['newsadded'])) {

		if (!empty($_POST['text']) && !empty($_POST['title'])) {
	
		if(empty($_POST['summary'])) {
		$title = $_POST['title'];
		$summary = $_POST['text'];
		$text = nl2br($_POST['text']);
		$user = $userlogged['user'];
		} else {
		$title = $_POST['title'];
		$summary = $_POST['summary'];
		$text = nl2br($_POST['text']);
		$user = $userlogged['user'];
		}
		mysql_query("INSERT INTO  `webcraft`.`news` (`id` ,`title` ,`summary` ,`text` ,`views` ,`date` ,`users`) VALUES (NULL ,  '{$title}',  '{$summary}',  '{$text}',  '0', NOW( ) ,  '{$userID}');");
		
		} else {
		
		die('<script language="javascript">alert("Fill in entire form.")</script><meta http-equiv="REFRESH" content="0; url=http://localhost/qx/admin.php?addnews">');
		}
		
		echo '<font color="green">New News added Succesfully</font>';
		
	} elseif(isset($_REQUEST['managenews'])) {
	

	$query = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());
	
	echo '<table id="customers"><tr><td><h4>Title</h4></td><td><h4>Summary</h4></td><td><h4>Author</h4></td><td><h4>Date</h4></td><td>&nbsp;</td></tr>';

	//Wyswietlanie newsa (rekurencja na ilosc newsów)
	while($row = mysql_fetch_array($query)) {
	 
	 $news_content = $row['text'];
	 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".$row['users']."'"));
	 $author = $user['user'];
	 $summary = substr($row['summary'], 0, 12); 

	 echo '<tr><td>'.$row['title'].'</td><td>'.$summary.'...</td><td>'.$author.'</td><td>'.$row['date'].'</td><td><a href="?editnews='.$row['id'].'"><img src="img/edit.gif" /></a> <a href="?delnews='.$row['id'].'"><img src="img/delete.png" /></a></td></tr>';
	 
	 }
	 
	 echo '</table>';
	
	} elseif(isset($_GET['delnews'])) {
	
	connectMySQL();
	$delnewsid = $_GET['delnews'];
	
	mysql_query("DELETE FROM news WHERE id = '{$delnewsid}';");
	echo 'News deleted Succesfully';
	echo '<br /><a href="?managenews">Back to News Managing</a>';
	
	} elseif(isset($_GET['editnews'])) {
	
	$editnewsid = $_GET['editnews'];
	$news_edit_query = mysql_query("SELECT * FROM news WHERE id = '{$editnewsid}';") or die(mysql_error());
	$newss = mysql_fetch_array($news_edit_query);
	
	
	echo '<h3>Editing: <em>'.$newss['title'].'</em></h3>';
	echo '<form action="?updatenews" class="form" method="POST">
	<p class="name">
		<strong>Title cannot be changed</strong>
	</p>
	
	<p class="text">
		<textarea class="textarea2" name="summary">'.$newss['summary'].'</textarea><br />
		<font size="2" color="grey">If empty, text will become summary</font><br />
	</p>

	<p class="text">
		<textarea class="textarea2" name="text">'.$newss['text'].'</textarea><br />
		<font size="2" color="grey">HTML is <b>ON</b><br />Auto line-break is <b>ON</b><br /></font><br />
	</p>
	
	<input type="hidden" name="id" value="'.$newss['id'].'" />
	<p class="submit">
		<input type="submit" class="button" value="Update news" />
	</p>

	</form>';
	
	} elseif(isset($_REQUEST['updatenews'])) {
	
	
	$summary_upd = $_POST['summary'];
	$text_upd = $_POST['text'];
	$id_upd = $_POST['id'];
	$news_edit_query = mysql_query("SELECT * FROM news WHERE id = '{$id_upd}';") or die(mysql_error());
	$newss = mysql_fetch_array($news_edit_query);
	
	if($summary_upd == $newss['summary'] && $text_upd == $newss['text']) {
	die('<script language="JavaScript">alert("You havent changed anything");</script><meta http-equiv="REFRESH" content="0; url=http://localhost/qx/admin.php?editnews='.$id_upd.'">');
	} else {
	mysql_query("UPDATE news SET summary = '{$summary_upd}', text = '{$text_upd}' WHERE id = '{$id_upd}';");
	
	echo '<strong>News updated succesfully!</strong><br />';
	echo 'Redirecting...';
	echo '<meta http-equiv="REFRESH" content="1; url=http://localhost/qx/admin.php?managenews">';
	}
	
	} elseif(isset($_REQUEST['adduser'])) {
	
	echo '
	<form action="?useradded" class="form" method="POST">

	<p class="name">
		<input class="input2" type="text" name="username" id="name" placeholder="Username" />
	</p>

	<p class="name">
		<input class="input2" type="password" name="password" id="name" placeholder="Password" />
	</p>

	<p class="name">
		<input class="input2" type="password" name="passwordconf" id="name" placeholder="Confirm Password" />
	</p>
	
	<p>
		<input type="checkbox" name="isadmin" value="isadmin">Admin permissions<br />(managing users)</input>
	</p>

	<p class="submit">
		<input type="submit" class="button" value="Add user" />
	</p>

	</form>
	';
	
	} elseif(isset($_REQUEST['useradded'])) {
	
	
	
	} elseif(isset($_REQUEST['manageusers'])) {
	
	
	echo '<a href="http://google.com">Google</a>';
	
	} elseif(isset($_REQUEST['info'])) {
	
	
	echo '<h2>NEWSystem® by Fszeker</h2><br /><strong>Script Version:</strong> '.$script_version.'<br /><strong>Build Date:</strong> '.$last_update.' ';
	
	} else {
	
	
	echo 'Hey, <b>'.$userlogged['user'].'</b> you can add or manage news or users. Enjoy!<br />';
	echo '<h3>Stats:</h3>';
	echo 'Thare are currently <strong>'.$newses.'</strong> newses in Database.<br /><br />';
	echo 'Thare are currently <strong>'.$users_num.'</strong> users in Database.<br /><br />';
	
	}
	
	?>
	<br />
	<br />
	

  </div>
  NEWSystem® All rights reserved. © 2012 by Fszeker
</body>
</html>