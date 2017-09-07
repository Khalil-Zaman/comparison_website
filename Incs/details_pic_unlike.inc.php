<?php
require('connect.inc.php');
require('core.inc.php');
if((isset($_POST['id']) && !empty($_POST['id'])) && (isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['pic_name']) && !empty($_POST['pic_name']))){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$category = $_POST['category'];
	$pic_name = $_POST['pic_name'];
	$likes = queryULT('likes','pics_of_items','pic_name',$pic_name);
	$query = "UPDATE `pics_of_items` SET `likes`=`likes`-1 WHERE `item_id`='".$id."' AND `category`='".$category."' AND `item_name`='".$name."' AND `pic_name`='".$pic_name."'";
	mysql_query($query);
	/*$query = "DELETE FROM `pic_likes` WHERE 
	`choice_id`='".$id."' AND
	`user`='".$_SESSION['user_username']."' AND
	`like`='1' AND
	`pic_name`='".$pic_name."' AND
	`category`='".$category."'
	"; */
	
	
	$query = "UPDATE `pic_likes` SET `like`='0' WHERE 
	`choice_id`='".$id."' AND
	`user`='".$_SESSION['user_username']."' AND
	`like`='1' AND
	`pic_name`='".$pic_name."' AND
	`category`='".$category."'
	";
	
	mysql_query($query);
	$likes--;
	//echo $likes;
}
?>