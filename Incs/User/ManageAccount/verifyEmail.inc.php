<?php
	require ("../../connect.inc.php");
	require ("../../core.inc.php");
	if(loggedin()){
		if(isset($_POST['Email'])){
			$email = $_POST['Email'];
			$query = "SELECT `username`, `id`, `email` FROM `users` WHERE 
			`id`='".$_SESSION['user_id']."' AND 
			`email`='".$email."' AND 
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