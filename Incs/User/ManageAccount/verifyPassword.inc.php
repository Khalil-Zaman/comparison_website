<?php
	require ("../../connect.inc.php");
	require ("../../core.inc.php");
	if(loggedin()){
		if(isset($_POST['password'])){
			$password = md5($_POST['password']);
			$query = "SELECT `password`, `username`, `id` FROM `users` WHERE 
			`id`='".$_SESSION['user_id']."' AND 
			`password`='".$password."' AND 
			`username`='".$_SESSION['user_username']."'";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows!=1){
				echo "0";
			} else {
				echo "1";
			}
		}
	}
?>