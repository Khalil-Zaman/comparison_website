<?php
require('connect.inc.php');
if((isset($_POST['other_user']))&&(isset($_POST['username_sending']))){
	$user_recieving  = $_POST['other_user'];
	$username_sending = $_POST['username_sending'];
	$query = "INSERT INTO `messages` VALUES (
	'',
	'".mysql_real_escape_string($user_recieving)."',
	'".mysql_real_escape_string($username_sending)."',
	'".time()."',
	'".mysql_real_escape_string($message)."'
	)";
	
	$query = "UPDATE `messages` SET `seen`='1' WHERE `user_recieving`='".$username_sending."' AND `user_sending`='".$user_recieving."'";
	mysql_query($query);
	
	if(!($query_run = mysql_query($query))){
		echo "Failed, please try again later";
	}
}
?>