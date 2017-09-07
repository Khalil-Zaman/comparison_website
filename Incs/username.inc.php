<?php
require ("connect.inc.php");
require ("core.inc.php");

if(isset($_POST["username"])){
	$username = mysql_real_escape_string($_POST['username']);
	$query = "SELECT `id` FROM `users` WHERE `username`='".$username."'";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	if ($query_num_rows>=1){
		echo "<span style='color:#FF3D3D; font-size:14px; font-style:italic;'>'".$username."'</span> <span style='font-size:12px; color:#404040;'>is already taken</span>";
	} else {
		echo "<span style='color:#2DBA06; font-size:14px; font-style:italic;'>'".$username."'</span> <span style='font-size:12px; color:#404040;'>is available</span>";
	}
}
?>