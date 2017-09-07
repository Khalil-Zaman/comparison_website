<?php 
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['item_id']) && !empty($_POST['item_id'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['review_id']) && !empty($_POST['review_id']))){
	$item_id = $_POST['item_id'];
	$category = $_POST['category'];
	$review_id = $_POST['review_id'];
	$query = "SELECT * FROM `likes_spec_reviews` WHERE
	`item_id`='".$item_id."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`review_id`='".$review_id."' AND
	`category`='".$category."'
	";
	$query_run = mysql_query($query);
	$mysql_num_rows = mysql_num_rows($query_run);
	if($mysql_num_rows>=1){
		$query_row = mysql_fetch_assoc($query_run);
		$if_like = $query_row['like'];
		$if_dislike = $query_row['dislike'];
		$query_2 = "UPDATE `likes_spec_reviews` SET `like`='0', `dislike`='1' WHERE 
			`item_id`='".$item_id."' AND 
			`user`='".$_SESSION['user_username']."' AND
			`review_id`='".$review_id."' AND
			`category`='".$category."'";
		mysql_query($query_2);
		if($if_like==1){
		$query = "UPDATE `spec_reviews` SET `dislikes`=`dislikes`+1, `likes`=`likes`-1 WHERE `item_id`='".$item_id."' AND `category`='".$category."' AND `id`='".$review_id."'";
		} else {
		$query = "UPDATE `spec_reviews` SET `dislikes`=`dislikes`+1 WHERE `item_id`='".$item_id."' AND `category`='".$category."' AND `id`='".$review_id."'";
		}
		mysql_query($query);
	} else {
		$query = "INSERT INTO `likes_spec_reviews`
		(`item_id`, `user`, `like`, `dislike`, `flag`, `time`, `category`, `review_id`) VALUES (
		'".$item_id."',
		'".$_SESSION['user_username']."',
		'0',
		'1',
		'0',
		'".time()."',
		'".$category."',
		'".$review_id."'
		)";
		mysql_query($query);
		$query = "UPDATE `spec_reviews` SET `dislikes`=`dislikes`+1 WHERE `item_id`='".$item_id."' AND `category`='".$category."' AND `id`='".$review_id."'";
		mysql_query($query);
	}
}
?>