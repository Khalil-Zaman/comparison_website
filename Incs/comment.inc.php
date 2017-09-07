<?php
if (isset($_POST["comment_section"])){
	$comment = $_POST["comment_section"];
	if (loggedin()){
		if (!empty($comment)){
			$query_compare_id = "SELECT `id` FROM `compare` WHERE `pageURL`='".$compare_comparison_url."' AND `category`='".$comparison_category."'";
			$query_run_com = mysql_query($query_compare_id);
			$query_row_com = mysql_fetch_assoc($query_run_com);
			$comparison_id = $query_row_com["id"];
			$query = "INSERT INTO `comments`(`compare_id`, `comment`, `user`, `user_id`, `time_added`, `category`) VALUES (
			'".$comparison_id."',
			'".mysql_real_escape_string($comment)."',
			'".$_SESSION['user_username']."',
			'".$_SESSION['user_id']."',
			'".time()."',
			'".$comparison_category."')";
			$queryComments = "UPDATE `compare` SET `comments`=`comments`+1 WHERE `category`='".$comparison_category."' AND `pageURL`='".$compare_comparison_url."'";
			mysql_query($queryComments);
			$query_run = mysql_query($query);
		}
	}
}
?>
