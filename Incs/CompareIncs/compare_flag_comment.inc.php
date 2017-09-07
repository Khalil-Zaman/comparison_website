<?php
require('../sessionStart.inc.php');
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['comment_id']) && !empty($_POST['comment_id'])) && (isset($_POST['category']) && !empty($_POST['category']))){
	$comment_id = $_POST['comment_id'];
	$category = $_POST['category'];
	$query = "SELECT * FROM `likes_comments_compare` WHERE 
	`category`='".$category."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`comment_id`='".$comment_id."'";
	$query_run = mysql_query($query);
	$mysql_num_rows = mysql_num_rows($query_run);
	if($mysql_num_rows>=1){
		$query_2 = "UPDATE `likes_comments_compare` SET `flag`='1' WHERE 
			`category`='".$category."' AND 
			`user`='".$_SESSION['user_username']."' AND
			`comment_id`='".$comment_id."'";
		mysql_query($query_2);
	} else {
		$query = "INSERT INTO `likes_comments_compare`
		(`category`, `like`, `dislike`, `flag`, `user`, `comment_id`, `time`) VALUES (
		'".$category."',
		'0',
		'0',
		'1',
		'".$_SESSION['user_username']."',
		'".$comment_id."',
		'".time()."'
		)";
		mysql_query($query);
	}
	$query = "UPDATE `comments` SET `flags`=`flags`+1 WHERE `id`='".$comment_id."' AND `category`='".$category."'";
	mysql_query($query);
}
?>