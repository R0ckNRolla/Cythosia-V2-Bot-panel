<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']) && $_SESSION['hydra_loggedin'] != 1)
	{
		header("Location: http://www.google.com");
	}
	$id = (int)$_GET['taskID'];
	include("inc/config.php");
	include("inc/funcs.php");

	$query = mysql_query("
	SELECT t.*, (SELECT count(*) FROM hydra_victims WHERE taskID=t.taskID) AS vics,
	(SELECT count(*) FROM hydra_task_done WHERE taskID=t.taskID) AS done FROM hydra_tasks AS t WHERE t.taskID='".mysql_real_escape_string((int)$id)."'");
	
	$ds = mysql_fetch_array($query);

	$table = '<table class="smalltable" style="width: 390px; margin: 5px;">';

	$table .= '<tr><th style="text-align:right;width:40%">Task ID:</th><td><b>'.$ds['taskID'].'</b></td></tr>';
	$table .= '<tr><th style="text-align:right;">Command:</th><td><b>'.$ds['command'].'</b></td></tr>';
	$table .= '<tr><th style="text-align:right;">Start Time:</th><td>'.date("d.m.Y H:i", $ds['time']).'</td></tr>';
	if($ds['elapsed']) $table .= '<tr><th style="text-align:right;">End Time:</th><td>'.date("d.m.Y H:i", $ds['elapsed']).'</td></tr>';
	$table .= '<tr><th style="text-align:right;">Number of Bots:</td><td>'.$ds['bots'].' Bots</td></tr>';
	if(!$ds['elapsed']) $table .= '<tr><th style="text-align:right;">Done by:</th><td>'.$ds['done'].' Bots</td></tr>';
	$table .= '</table><div style="text-align:right;padding:10px"><a href="#" onclick="deleteTask('.$ds['taskID'].')" class="button"><span>Delete Task</span></a></div>';
	
	echo $table;

?>