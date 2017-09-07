<?php
if(loggedin()){
	if(isset($_POST['message_section'])){
		$message = htmlentities(mysql_real_escape_string($_POST['message_section']));
		$query = "INSERT INTO `messages`(`user_recieving`, `user_sending`, `time`, `message`) VALUES (
		'".$username."',
		'".$_SESSION['user_username']."',
		'".time()."',
		'".$message."'
		)";
		if(!($query_run = mysql_query($query))){
			echo "Sorry, it had failed, please try again later.";
		} else {
			header("LOCATION: user.php?=".$_SESSION['user_username']."-view-all_messages-".$username."-user-view_all_messages");
		}
	}
}
?>