<?php
require('connect.inc.php');
if((isset($_POST['message']))&&(isset($_POST['other_user']))&&(isset($_POST['username_sending']))){
	$message = htmlentities(mysql_real_escape_string($_POST['message']));
	$user_recieving  = $_POST['other_user'];
	$username_sending = $_POST['username_sending'];
	echo $user_recieving." ".$username_sending." ".$message;
	$query = "INSERT INTO `messages` VALUES (
	'',
	'".mysql_real_escape_string($user_recieving)."',
	'".mysql_real_escape_string($username_sending)."',
	'".time()."',
	'".mysql_real_escape_string($message)."',
	'0'
	)";
	
	if(!($query_run = mysql_query($query))){
		echo "failed";
	} else {
		echo "Success";
	}
}
?>