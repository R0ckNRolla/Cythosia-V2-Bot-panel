<?php
function dRead($name) {
	return mysql_real_escape_string($_POST[$name]);
}
?>