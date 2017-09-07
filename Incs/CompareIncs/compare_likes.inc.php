<?php
if((isset($_POST['review_section']))&&!empty($_POST['review_section'])){
	$review = $_POST['review_section'];
	$query = "INSERT INTO `reviews` (`category`, `user`, `review`, `pageURL`) VALUES (
	'".$comparison_category."',
	'".$_SESSION['user_username']."',
	'".$review."',
	'".$compare_comparison_url."'
	)";
	if ($query_run = mysql_query($query)){
		echo "Successfull";
	} else {
		echo "Nah";
	}
}

function likeComparisonLeft ($left){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumbs_up_comparison_left_loggedin";
		if($left==1){
			$class .= " thumbs_up_comparison_already_left_loggedin";
		}
	} else {
		$class .= " thumbs_up_comparison_left";
		if($left==1){
			$class .= " thumbs_up_comparison_already_left";
		}
	}
	echo $class;
}

function likeComparisonRight ($right){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumbs_up_comparison_right_loggedin";
		if($right==1){
			$class .= " thumbs_up_comparison_already_right_loggedin";
		}
	} else {
		$class .= " thumbs_up_comparison_right";
		if($right==1){
			$class .= " thumbs_up_comparison_already_right";
		}
	}
	echo $class;
}

function likeReviewComp ($category, $Url, $id){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumb_up_review_comp";
		$query_2 = "SELECT * FROM `likes_reviews` WHERE `category`='".$category."' AND `pageUrl`='".$Url."' AND `review_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['like']==1){
				$class .= " already_liked_before_review_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}

function dislikeReviewComp ($category, $Url, $id){
	$class = "thumbs_down";
	if(loggedin()){
		$class .= " thumb_down_review_comp";
		$query_2 = "SELECT * FROM `likes_reviews` WHERE `category`='".$category."' AND `pageUrl`='".$Url."' AND `review_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['dislike']==1){
				$class .= " already_disliked_before_review_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}
function flagReviewComp($category, $Url, $id){
	$class = "flag";
	if(loggedin()){
		$class .= " flag_review_comp";
		$query_2 = "SELECT * FROM `likes_reviews` WHERE `category`='".$category."' AND `pageUrl`='".$Url."' AND `review_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['flag']==1){
				$class .= " already_flagged_before_review_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}
?>