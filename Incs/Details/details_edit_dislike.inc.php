<?php 
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['id']) && !empty($_POST['id'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['edit_id']) && !empty($_POST['edit_id']))){
	$id = $_POST['id']; // CHOICE ID
	$category = $_POST['category'];
	$edit_id = $_POST['edit_id'];
	$query = "SELECT * FROM `details_info_likes` WHERE 
	`item_id`='".$id."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`edit_id`='".$edit_id."' AND
	`category`='".$category."'
	";
	$query_run = mysql_query($query);
	$mysql_num_rows = mysql_num_rows($query_run);
	if($mysql_num_rows>=1){
		$query_row = mysql_fetch_assoc($query_run);
		$if_like = $query_row['like'];
		$if_dislike = $query_row['dislike'];
		$query_2 = "UPDATE `details_info_likes` SET `like`='0', `dislike`='1' WHERE 
			`item_id`='".$id."' AND 
			`user`='".$_SESSION['user_username']."' AND
			`edit_id`='".$edit_id."' AND
			`category`='".$category."'";
		mysql_query($query_2);
		if($if_like==1){
		$query = "UPDATE `edits` SET `dislikes`=`dislikes`+1, `likes`=`likes`-1 WHERE `id_of_item`='".$id."' AND `category`='".$category."' AND `id`='".$edit_id."'";
		} else {
		$query = "UPDATE `edits` SET `dislikes`=`dislikes`+1 WHERE `id_of_item`='".$id."' AND `category`='".$category."' AND `id`='".$edit_id."'";
		}
		mysql_query($query);
	} else {
		$query = "INSERT INTO `details_info_likes`
		(`item_id`,  `like`, `dislike`, `flag`, `category`, `user`, `time`, `edit_id`) VALUES (
		'".$id."',
		'0',
		'1',
		'0',
		'".$category."',
		'".$_SESSION['user_username']."',
		'".time()."',
		'".$edit_id."'
		)";
		mysql_query($query);
		$query = "UPDATE `edits` SET `dislikes`=`dislikes`+1 WHERE `id_of_item`='".$id."' AND `category`='".$category."' AND `id`='".$edit_id."'";
		mysql_query($query);
	}
}
?>