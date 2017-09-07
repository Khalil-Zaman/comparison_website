<?php 
require('core.inc.php');
require('connect.inc.php');
if(isset($_POST['src'])){
	$src = $_POST['src'];
	$second_hash_pos = strpos($src,'/',9);
	$pic_name = substr($src, ($second_hash_pos+1));
	$likes = queryULT('likes','pics_of_items','pic_name',$pic_name);
	echo $likes;
}
?>