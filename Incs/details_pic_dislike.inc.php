<?php
require('connect.inc.php');
require('core.inc.php');
if((isset($_POST['id']) && !empty($_POST['id'])) && (isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['pic_name']) && !empty($_POST['pic_name']))){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$category = $_POST['category'];
	$pic_name = $_POST['pic_name'];
	$query = "SELECT * FROM `pic_likes` WHERE 
	`choice_id`='".$id."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`pic_name`='".$pic_name."' AND
	`category`='".$category."'
	";
	$query_run = mysql_query($query);
	$mysql_num_rows = mysql_num_rows($query_run);
	if($mysql_num_rows>=1){
		$query_row = mysql_fetch_assoc($query_run);
		$if_like = $query_row['like'];
		$if_dislike = $query_row['dislike'];
		$query_2 = "UPDATE `pic_likes` SET `like`='0', `dislike`='1' WHERE 
			`choice_id`='".$id."' AND 
			`user`='".$_SESSION['user_username']."' AND
			`pic_name`='".$pic_name."' AND
			`category`='".$category."'";
		mysql_query($query_2);
		if($if_like==1){
		$query = "UPDATE `pics_of_items` SET `dislikes`=`dislikes`+1, `likes`=`likes`-1 WHERE `item_id`='".$id."' AND `category`='".$category."' AND `item_name`='".$name."'";
		} else {
		$query = "UPDATE `pics_of_items` SET `dislikes`=`dislikes`+1 WHERE `item_id`='".$id."' AND `category`='".$category."' AND `item_name`='".$name."'";
		}
		mysql_query($query);
	} else {
		$query = "INSERT INTO `pic_likes`
		(`choice_id`, `user`, `like`, `dislike`, `time`, `pic_name`, `category`) VALUES (
		'".$id."',
		'".$_SESSION['user_username']."',
		'0',
		'1',
		'".time()."',
		'".$pic_name."',
		'".$category."'
		)";
		mysql_query($query);
		$query = "UPDATE `pics_of_items` SET `dislikes`=`dislikes`+1 WHERE `item_id`='".$id."' AND `category`='".$category."' AND `item_name`='".$name."'";
		mysql_query($query);
	}
}
?>