<?php
	// Config.php	
	
	// Zeiten
	$time_on = (15*60)+15;			// Zeit die er als online angezeigt wird in Sekunden
		
	// MySQL
	$mysql_server = "localhost";
	$mysql_user = "    ";
	$mysql_pw = "     ";
	$mysql_db = "     ";
	$link = mysql_connect($mysql_server, $mysql_user, $mysql_pw);
	mysql_select_db($mysql_db, $link);
?>