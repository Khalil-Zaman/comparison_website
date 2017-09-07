<?php
if(!loggedin()){
	if (isset ($_POST["reg_username"]) && isset ($_POST["reg_password"]) && isset ($_POST["reg_password_again"]) && isset ($_POST["reg_firstname"]) && 
	isset ($_POST["reg_surname"]) && isset ($_POST["reg_email"])){
		$reg_username = $_POST["reg_username"];
		$reg_password = $_POST["reg_password"];
		$reg_password_again = $_POST["reg_password_again"];
		$reg_firstname = $_POST["reg_firstname"];
		$reg_surname = $_POST["reg_surname"];
		$reg_email = $_POST["reg_email"]; // if the fields (except picture) are submitted 
		
		if (!empty($reg_username) && !empty($reg_password) && !empty($reg_password_again) && !empty($reg_firstname) 
		&& !empty($reg_surname) && !empty($reg_email)){
			// if the fields (except picture) are filled in
			if ($reg_password!=$reg_password_again){
				// if the password matches the repeated password
				echo "Passwords do not match";
			} else {
				// check if account with the email has already been made
				$query = "Select `email` from `users` WHERE `email`='".$reg_email."'";
				$query_run = mysql_query($query);
				if (mysql_num_rows($query_run)>=1){
					// account with email has already been made
					echo "An account with the email given, has already been made";
				} else {
					// account with email has not previously been made. Therefore, continue 
					$reg_password_hash = md5($reg_password);
					$query001 = "INSERT INTO `users`(`id`, `username`, `password`, `firstname`, `surname`, `email`, `pic_file`, `time_joined`) VALUES (
					'',
					'".mysql_real_escape_string($reg_username)."',
					'".mysql_real_escape_string($reg_password_hash)."',
					'".mysql_real_escape_string($reg_firstname)."',
					'".mysql_real_escape_string($reg_surname)."',
					'".mysql_real_escape_string($reg_email)."',
					'',
					'".time()."')";
					
					if ($query_run = mysql_query($query001)){
						// if query has run successfully continue checking
						$query = "SELECT `id`,`username`,`firstname` FROM `users` WHERE `username`= '$reg_username' AND `password` = '$reg_password_hash'";
						$query_run = mysql_query($query);
						$user_id = mysql_result($query_run, 0, 'id');
						$user_username = mysql_result($query_run, 0, 'username');
						$user_firstname = mysql_result($query_run, 0, 'firstname');
						$_SESSION['user_id'] = $user_id;
						$_SESSION['user_username'] = $user_username;
						$_SESSION['user_firstname'] = $user_firstname; 
							$query = "UPDATE `users` SET `pic_file`='default_pic' WHERE `username`='".$_SESSION['user_username']."'"; 
							if (mysql_query($query)){
							?>
							<script>
							window.location.replace( <?php echo " 'user.php?=".$user_username."-view-user' "?> );
							</script>
							<?php
							
							//	header("Location: user.php?=".$user_username."-view-user");
							} else {
								echo "Sorry, could not set default";
								//header("Location: register_success.php");
							}
					} else {
						echo "Sorry, we could not register you at this time";
					}
				}
			}
		} else {
			echo "All fields are required.";
		} 
	}
}
?>