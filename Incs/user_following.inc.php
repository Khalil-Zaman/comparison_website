<?php
require('connect.inc.php');
require('core.inc.php');
$error = "Sorry, please try again later...";
if(isset($_POST['user_followed'])){
	$user_followed = $_POST['user_followed'];
	$user_following = $_SESSION['user_username'];
	$query = "SELECT * FROM `following` WHERE `user_followed`='".$user_followed."' AND `user_following`='".$user_following."'";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	if($query_num_rows==0){
		$query_ins = "INSERT INTO `following` (`user_following`, `user_followed`, `time`) VALUES (
		'".$user_following."',
		'".$user_followed."',
		'".time()."')";
		
		$following_number = queryULT('following','users','username',$user_following);
		$following_number = $following_number + 1;
		queryUPD('users','following',$following_number,'username',$user_following);
		
		$follower_number = queryULT('followers','users','username',$user_followed);
		$follower_number = $follower_number + 1;
		queryUPD('users','followers',$follower_number,'username',$user_followed);
		
		if (mysql_query($query_ins)){
			echo "Following";
		} else {
			echo $error;
		}
	} else {
		$query_row = mysql_fetch_assoc($query_run);
		if($query_row['unfollow']=='1'){
			$query = "UPDATE `following` SET `unfollow`='0', `time`='".time()."',`time_unfollow`='0' WHERE `user_followed`='".$user_followed."' AND 
			`user_following`='".$user_following."' AND `unfollow`='1'";
			
			$following_number = queryULT('following','users','username',$user_following);
			$following_number = $following_number + 1;
			queryUPD('users','following',$following_number,'username',$user_following);
			
			$follower_number = queryULT('followers','users','username',$user_followed);
			$follower_number = $follower_number + 1;
			queryUPD('users','followers',$follower_number,'username',$user_followed);
			
			if (mysql_query($query)){
				echo "Following";
			} else {
				echo $error;
			}
		} else {
			$query = "UPDATE `following`  SET `unfollow`='1', `time_unfollow`='".time()."' WHERE `user_followed`='".$user_followed."' AND `user_following`='".$user_following."' AND `unfollow`='0'";
			
			$following_number = queryULT('following','users','username',$user_following);
			$following_number = $following_number - 1;
			queryUPD('users','following',$following_number,'username',$user_following);
			
			$follower_number = queryULT('followers','users','username',$user_followed);
			$follower_number = $follower_number - 1;
			queryUPD('users','followers',$follower_number,'username',$user_followed);
			
			if (mysql_query($query)){
				echo "Follow";
			} else {
				echo $error;
			}
		}
	}
}
?>