<?php 
if (isset($_POST["post_section"])){
	$post = $_POST["post_section"];
	if (!empty($post)){
		$date = new DateTime();
		$time = $date->format('D, d M Y g:i a');
		$comparison_date = date("Y-m-d H:i:s");
		$query = "SELECT `replies`,`category` FROM `forum_general_topics` WHERE `name`='".$topic_name."' AND `category`='".$category."'";
		$query_run = mysql_query($query);
		$query_row = mysql_fetch_assoc($query_run);
		$replies = $query_row["replies"];
		$category = $query_row["category"];
		$replies++;
		$query = "UPDATE `forum_general_topics` SET 
		`last_post_by`='".$_SESSION['user_username']."',
		`replies`='".$replies."',
		`last_post_time`='".$time."',
		`comparison_time_posted`='".$comparison_date."'
		WHERE `name`='".$topic_name."' AND `category`='".$category."'";
		$query_run = mysql_query($query);
		$query = "INSERT INTO `forum_posts` VALUES (
		'',
		'".$_SESSION['user_username']."',
		'".mysql_real_escape_string($category)."',
		'".mysql_real_escape_string($topic_name)."',
		'".mysql_real_escape_string($post)."',
		'".$time."',
		'".$comparison_date."'
		)";		
		if($queery_run = mysql_query($query)){
			
		} else {
			echo "failed";
		}
	} else {
		echo "Please type something";
	}
}
?>