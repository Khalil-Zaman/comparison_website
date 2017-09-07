<?php
	require ("../../connect.inc.php");
	require ("../../core.inc.php");
	if(loggedin()){
		if((isset($_POST['newEmail']))&&(isset($_POST['oldEmail']))){
			$email = $_POST['newEmail'];
			$oldEmail = $_POST['oldEmail'];
			$queryCheckSame = "SELECT `email`,`username` FROM `users` WHERE 
			`email`='".$email."'";
			$queryCheckSameRun = mysql_query($queryCheckSame);
			$query_num_rows = mysql_num_rows($queryCheckSameRun);
			if($query_num_rows>0){
				$query_row = mysql_fetch_assoc($queryCheckSameRun);
				if($query_row['username']==$_SESSION['user_username']){
					echo "3";
				} else {
					echo "2";
				}
			} else {
				$query = "UPDATE `users` SET `email`='".$email."' WHERE 
				`id`='".$_SESSION['user_id']."' AND 
				`email`='".$oldEmail."' AND 
				`username`='".$_SESSION['user_username']."'";
				if(mysql_query($query)){
					echo "1";
				} else {
					echo "0";
				}
			}
		}
	}
?>