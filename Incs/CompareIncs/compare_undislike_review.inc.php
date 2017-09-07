<?php
require('../sessionStart.inc.php');
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['review_id']) && !empty($_POST['review_id'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['pageUrl']) && !empty($_POST['pageUrl']))){
	$review_id = $_POST['review_id'];
	$category = $_POST['category'];
	$pageUrl = $_POST['pageUrl'];
	$query = "UPDATE `reviews` SET `dislikes`=`dislikes`-1 WHERE `id`='".$review_id."' AND `category`='".$category."' AND `pageURL`='".$pageUrl."'";
	mysql_query($query);	
	$query = "UPDATE `likes_reviews` SET `like`='0', `dislike`='0' WHERE 
	`category`='".$category."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`pageUrl`='".$pageUrl."' AND
	`review_id`='".$review_id."'
	";
	mysql_query($query);
}
?>