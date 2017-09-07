<?php
require('../connect.inc.php');
require('../core.inc.php');
if((isset($_POST['item_id']) && !empty($_POST['item_id'])) && (isset($_POST['category']) && !empty($_POST['category']))
&& (isset($_POST['review_id']) && !empty($_POST['review_id']))){
	$item_id = $_POST['item_id'];
	$category = $_POST['category'];
	$review_id = $_POST['review_id'];
	$query = "UPDATE `spec_reviews` SET `flags`=`flags`-1 WHERE `item_id`='".$item_id."' AND `category`='".$category."' AND `id`='".$review_id."'";
	mysql_query($query);	
	$query = 
	"UPDATE `likes_spec_reviews` SET `flag`='0' WHERE 
	`item_id`='".$item_id."' AND 
	`user`='".$_SESSION['user_username']."' AND
	`review_id`='".$review_id."' AND
	`category`='".$category."'";
	mysql_query($query);
}
?>