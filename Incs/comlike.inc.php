<?php
require ("connect.inc.php");
require ("core.inc.php");

if(isset($_GET["table_name"]) && isset($_GET['comment_id']) && isset($_GET['likes'])){
	$table_name = $_GET["table_name"];
	$comment_id= $_GET["comment_id"];
	$likes = $_GET["likes"];
	@$query = "UPDATE `".$table_name."` SET `like`='".$likes."' WHERE `id`='".$comment_id."'";
	if (@$query_run = mysql_query($query)){
		echo $likes;
	} else {
		echo "Sorry try again";
	}
}
?>