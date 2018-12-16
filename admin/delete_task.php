<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']) && $_SESSION['hydra_loggedin'] != 1)
	{
		header("Location: http://www.google.com");
	}
	$id = $_GET['taskID'];
	
	include("inc/config.php");
	include("inc/funcs.php");
	
	mysql_query("DELETE FROM hydra_tasks WHERE taskID = '".mysql_real_escape_string((int)$id)."'");
	mysql_query("DELETE FROM hydra_task_done WHERE taskID = '".mysql_real_escape_string((int)$id)."'");
	mysql_query("UPDATE hydra_victims SET taskID = 0 WHERE taskID = '".mysql_real_escape_string((int)$id)."'");
	echo "Task successfully deleted!";
?>