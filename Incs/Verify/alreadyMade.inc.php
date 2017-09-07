<?php
#require('../sessionStart.inc.php');
require('../connect.inc.php');
require('../core.inc.php');
if (isset($_POST["id"])&&isset($_POST["category"])&&isset($_POST["url"])){
	$id = $_POST["id"];
	$category = $_POST["category"];
	$url = $_POST["url"];
	$query = "SELECT `verified`,`delete`, `Name`, `user_added` FROM `".$category."` WHERE `id`='".$id."'";
	$query_run = mysql_query($query);
	$query_row = mysql_fetch_assoc($query_run);
	$NameItem = $query_row['Name'];
	$user_added = $query_row["user_added"];
	if(($query_row["verified"]==0)&&($query_row["delete"]==0)){
		//$query_2 = "UPDATE `".$category."` SET `delete`='1', `time_verified`='".time()."' WHERE `id`='".$id."'";
		
		$query_3 = "SELECT * FROM `".$category."` WHERE `verified`='0' AND `delete`='0' AND `id`='".$id."'";
		$query_run_3 = mysql_query($query_3);
		$query_row_3 = mysql_fetch_assoc($query_run_3);
		$pic_name = $query_row_3["pic_name"];
		$icon_pic = $query_row_3["icon_img"];
		
		$query_2 = "DELETE FROM `".$category."` WHERE `id`='".$id."'";
		$query_run_2= mysql_query($query_2);
		if(!$query_run_2){
			echo "Failed"; // FAIL
		} else {
					
			//unlink($_SERVER['DOCUMENT_ROOT']."/Website/Pictures/".$category."/".queryULT("pic_name",$category,"id",$id));//PRACTISE
			$filename = "../../Pictures/".ucfirst($category)."/".$pic_name;
			if (file_exists($filename)) {
				#if(unlink($_SERVER['DOCUMENT_ROOT']."/Website/Pictures/".ucfirst($category)."/".$pic_name)){ //ONLINE
				if(unlink($_SERVER['DOCUMENT_ROOT']."/Pictures/".ucfirst($category)."/".$pic_name)){
					echo "Success";
				} else {
					echo "Failed ";
				}
			}
			
			if($category=="games"){
				$filename = "../../Pictures/".ucfirst($category)."/Icons/".$icon_pic;
				if (file_exists($filename)) {
					#unlink($_SERVER['DOCUMENT_ROOT']."/Website/Pictures/".$category."/Icons/".$icon_pic);//PRACTISE
					unlink($_SERVER['DOCUMENT_ROOT']."/Pictures/".ucfirst($category)."/Icons/".$icon_pic);//ONLINE
				}
			}
			$query3 = "INSERT INTO `messages`(`user_recieving`, `user_sending`, `time`, `message`, `seen`) VALUES (
			'".$user_added."',
			'ADMIN',
			'".time()."',
			'".$NameItem." was not verified. It has already been made. Click <a href=\'".$url."\'>here</a> to view the item.',
			'0')";
			mysql_query($query3);
		}
	}
}
?>