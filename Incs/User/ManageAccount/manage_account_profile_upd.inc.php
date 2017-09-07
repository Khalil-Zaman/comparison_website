<?php
require ("../../connect.inc.php");
require ("../../core.inc.php");
if((isset($_POST['x1']))&&(isset($_POST['x2']))&&(isset($_POST['y1']))&&(isset($_POST['y1']))){
	$no_times = queryULT('no_dp_changed','users','username',$_SESSION['user_username']);
	$no_times++;
	$x1 = $_POST['x1'];
	$x2 = $_POST['x2'];
	$y1 = $_POST['y1'];
	$y2 = $_POST['y2'];
	$query = "UPDATE `users` SET 
	`dp_x1`='".$x1."',	
	`dp_x2`='".$x2."',	
	`dp_y1`='".$y1."',	
	`dp_y2`='".$y2."',
	`no_dp_changed`='".$no_times."'
	WHERE `username`='".$_SESSION['user_username']."'";
	if($query_run = mysql_query($query)){
		echo "Uploaded";
	} else {
		echo "Failred";
	}
	
}
?>

