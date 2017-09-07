<?php
require ("connect.inc.php");
require ("core.inc.php");

if(isset($_POST["email"])){
	$email = $_POST['email'];
	$query = "SELECT `id` FROM `users` WHERE `email`='".$email."'";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	if ($query_num_rows>=1){
		echo "<span style='color:#FF3D3D; font-size:14px; font-style:italic;'>'".$email."'</span> <span style='font-size:12px; color:#404040;'>is already being used</span>";
	} else {
		// echo "<span style='color:#2DBA06; font-size:14px; font-style:italic;'>'".$email."'</span> <span style='font-size:12px; color:#404040;'>is available</span>";
	}
}
?>