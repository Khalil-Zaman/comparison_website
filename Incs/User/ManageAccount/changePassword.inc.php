<?php
	require ("../../connect.inc.php");
	require ("../../core.inc.php");
	if(loggedin()){
		if((isset($_POST['newPassword']))&&(isset($_POST['oldPassword']))){
			$password = md5($_POST['newPassword']);
			$oldPassword = md5($_POST['oldPassword']);
			$query = "UPDATE `users` SET `password`='".$password."' WHERE 
			`id`='".$_SESSION['user_id']."' AND 
			`password`='".$oldPassword."' AND 
			`username`='".$_SESSION['user_username']."'";
			if(mysql_query($query)){
				echo "1";
			} else {
				echo "0";
			}
		}
	}
?>