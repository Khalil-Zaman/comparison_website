<?php
require ("connect.inc.php");
require ("core.inc.php");
if(isset($_GET["table_name"]) && isset($_GET['comment_id']) && isset($_GET['dislikes'])){
	$table_name = $_GET["table_name"];
	$comment_id= $_GET["comment_id"];
	$dislikes = $_GET["dislikes"];
	@$query = "UPDATE `".$table_name."` SET `dislike`='".$dislikes."' WHERE `id`='".$comment_id."'";
	if (@$query_run = mysql_query($query)){
		echo $dislikes;
	} else {
		echo "Sorry try again";
	}
}
?>