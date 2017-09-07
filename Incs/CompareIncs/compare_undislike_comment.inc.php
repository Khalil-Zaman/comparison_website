<?php
require('../sessionStart.inc.php');
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['comment_id']) && !empty($_POST['comment_id'])) && (isset($_POST['category']) && !empty($_POST['category']))){
	$comment_id = $_POST['comment_id'];
	$category = $_POST['category'];
	$query = "UPDATE `comments` SET `dislikes`=`dislikes`-1 WHERE `id`='".$comment_id."' AND `category`='".$category."'";
	mysql_query($query);	
	$query = "UPDATE `likes_comments_compare` SET `like`='0', `dislike`='0' WHERE 
	`category`='".$category."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`comment_id`='".$comment_id."'
	";
	mysql_query($query);
}
?>