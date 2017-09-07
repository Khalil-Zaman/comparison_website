<?php
#require ("sessionStart.inc.php");
require "core.inc.php";
require "connect.inc.php";

if(isset($_POST["category"]) && isset($_POST["url"])){
	$category = $_POST["category"];
	$comparison_url = $_POST["url"];
	if (loggedin()){
		$query = "SELECT * FROM `likes` WHERE 
		`category`='".$category."' AND 
		`username`='".$_SESSION['user_username']."' AND
		`pageURL`='".$comparison_url."'
		"; // CHECK TO SEE IF PREVIOUSLY LIKED OR UNLIKED
		$query_run = mysql_query($query);
		$mysql_num_rows = mysql_num_rows($query_run);
		if($mysql_num_rows>=1){
			$query_row = mysql_fetch_assoc($query_run);
			$if_left = $query_row['left'];
			$if_right = $query_row['right'];
			$query_2 = "UPDATE `likes` SET `left`='1', `right`='0' WHERE 
				`category`='".$category."' AND 
				`username`='".$_SESSION['user_username']."' AND
				`pageURL`='".$comparison_url."'";
			mysql_query($query_2);
			if($if_right==1){
				$query = "UPDATE `compare` SET 
				`choice1_likes`=`choice1_likes`+1, `choice1_likes_users`=`choice1_likes_users`+1,
				`choice2_likes`=`choice2_likes`-1, `choice2_likes_users`=`choice2_likes_users`-1
				WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
			} else {
				$query = "UPDATE `compare` SET 
				`choice1_likes`=`choice1_likes`+1, `choice1_likes_users`=`choice1_likes_users`+1
				WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
			}
			mysql_query($query);
		} else {
			$query = "INSERT INTO `likes`
			(`category`, `pageURL`, `username`, `userid`, `left`, `right`, `time`) VALUES (
			'".$category."',
			'".$comparison_url."',
			'".$_SESSION['user_username']."',
			'".$_SESSION['user_id']."',
			'1',
			'0',
			'".time()."'
			)";
			mysql_query($query);
			$query = "UPDATE `compare` SET 
			`choice1_likes`=`choice1_likes`+1, `choice1_likes_users`=`choice1_likes_users`+1
			WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
			mysql_query($query);
		}
	} else { // NON LOGGED IN USERS
		if(isset($_SESSION[$category."_".$comparison_url.'_right'])){ // CHECK TO SEE IF USER HAS ALREADY LIKED RIGHT SIDE
			if($_SESSION[$category."_".$comparison_url.'_right']=='1'){
				$query = "UPDATE `compare` SET 
				`choice1_likes`=`choice1_likes`+1, `choice1_likes_public`=`choice1_likes_public`+1,
				`choice2_likes`=`choice2_likes`-1, `choice2_likes_public`=`choice2_likes_public`-1
				WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
				mysql_query($query);
				$_SESSION[$category."_".$comparison_url.'_right']='0';
				$_SESSION[$category."_".$comparison_url.'_left']='1';
			} else { // USER PREVIOUSLY UNLIKED RIGHT HAND SIDE, THEREFORE, SESSION IS STILL PRESENT
				$query = "UPDATE `compare` SET 
				`choice1_likes`=`choice1_likes`+1, `choice1_likes_public`=`choice1_likes_public`+1
				WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
				mysql_query($query);
				$_SESSION[$category."_".$comparison_url.'_left']='1';
			}
		} else {
			$query = "UPDATE `compare` SET
			`choice1_likes`=`choice1_likes`+1, `choice1_likes_public`=`choice1_likes_public`+1
			WHERE `pageURL`='".$comparison_url."' AND `category`='".$category."'";
			mysql_query($query);
			$_SESSION[$category."_".$comparison_url.'_left']='1';
		}
	}
}
?>