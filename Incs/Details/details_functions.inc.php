<?php

//TOTAL LIKES
$query = "SELECT `choice_1`,`choice_2`,`category`,
`choice1_likes_users`,`choice1_likes_public`,`choice1_likes`,
`choice2_likes_users`,`choice2_likes_public`,`choice2_likes` FROM `compare`
 WHERE (`choice_1`='".$choice_id."' OR `choice_2`='".$choice_id."') AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$likes_users = $likes_public = $likes_total = 0;
$likes_usersAg = $likes_publicAg = $likes_totalAg = 0;
$no_comparisons = $noWins = 0;
while($query_row = mysql_fetch_assoc($query_run)){
	if($query_row['choice_1']==$choice_id){
		$likes_users += $query_row['choice1_likes_users'];
		$likes_public += $query_row['choice1_likes_public'];
		$likes_total += $query_row['choice1_likes'];
		$likes_usersAg += $query_row['choice2_likes_users'];
		$likes_publicAg += $query_row['choice2_likes_public'];
		$likes_totalAg += $query_row['choice2_likes'];
		if ($query_row['choice1_likes'] > $query_row['choice2_likes'] ){
			$noWins++;
		}
	} else if($query_row['choice_2']==$choice_id){
		$likes_users += $query_row['choice2_likes_users'];
		$likes_public += $query_row['choice2_likes_public'];
		$likes_total += $query_row['choice2_likes'];
		$likes_usersAg += $query_row['choice1_likes_users'];
		$likes_publicAg += $query_row['choice1_likes_public'];
		$likes_totalAg += $query_row['choice1_likes'];
		if ($query_row['choice2_likes'] > $query_row['choice1_likes'] ){
			$noWins++;
		}
	}
	$no_comparisons++;
}
@$likes_users_percentage = number_format((float)(($likes_users/($likes_users+$likes_usersAg))*100), 2, '.', '');
@$likes_public_percentage =  number_format((float)(($likes_public/($likes_public+$likes_publicAg))*100), 2, '.', '');
@$likes_total_percentage =  number_format((float)(($likes_total/($likes_total+$likes_totalAg))*100), 2, '.', '');
@$wins_total_percentage =  number_format((float)(($noWins/($no_comparisons))*100), 2, '.', '');

//REVIEWS
if(isset($_POST['review_section_spec']) && !empty($_POST['review_section_spec'])){
	$review_new = mysql_real_escape_string(htmlentities($_POST['review_section_spec']));
	$query = "INSERT INTO `spec_reviews`(`category`, `user`, `user_added_id`, `review`, `item_id`, `time_added`) VALUES (
	'".$comparison_category."',
	'".$_SESSION['user_username']."',
	'".$_SESSION['user_id']."',
	'".$review_new."',
	'".$choice_id."',
	'".time()."'
	)";
	mysql_query($query);
}

function like_pic($like, $dislike){
	if(loggedin()){
		if ($like == 1) {
			echo "thumbs_up thumb_up_image already_liked_before";
		} else {
			echo "thumbs_up thumb_up_image";
		}
	} else {
		echo "thumbs_up need_login";
	}
}
function dislike_pic($like, $dislike){
	if(loggedin()){
		if ($dislike == 1) {
			echo "thumbs_down thumb_down_image already_disliked_before";
		} else {
			echo "thumbs_down thumb_down_image";
		}
	} else {
		echo "thumbs_down need_login";
	}
}
function flag($flag){
	if(loggedin()){
		if ($flag == 1) {
			echo "flag flag_image already_flagged_before";
		} else {
			echo "flag flag_image";
		}
	} else {
		echo "flag need_login";
	}
}

function editLikesLike($id, $choice_id, $category){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumb_up_edit";
		$query_2 = "SELECT * FROM `details_info_likes` WHERE `item_id`='".$choice_id."' AND `category`='".$category."' AND `edit_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['like']==1){
				$class .= " already_liked_edit_before";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}
function editLikesDislike($id, $choice_id, $category){
	$class = "thumbs_down";
	if(loggedin()){
		$class .= " thumb_down_edit";
		$query_2 = "SELECT * FROM `details_info_likes` WHERE `item_id`='".$choice_id."' AND `category`='".$category."' AND `edit_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['dislike']==1){
				$class .= " already_disliked_edit_before";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}
function editFlag($id, $choice_id, $category){
	$class = "flag";
	if(loggedin()){
		$class .= " flag_image_edit";
		$query_2 = "SELECT * FROM `details_info_likes` WHERE `item_id`='".$choice_id."' AND `category`='".$category."' AND `edit_id`='".$id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['flag']==1){
				$class .= " already_flagged_before_edit";
			}
		}
	} else {
		$class .= " need_login";
	}
	echo $class;
}

function likeReview($review_id, $choice_id, $category){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumb_up_review";
		$query_2 = "SELECT * FROM `likes_spec_reviews` WHERE `review_id`='".$review_id."' AND `category`='".$category."' AND `item_id`='".$choice_id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['like']==1){
				$class .= " already_liked_before_review";
			}
		}
	} else {
		$class .= " need_loginReview";
	}
	echo $class;
}
function flagReview($review_id, $choice_id, $category){
	$class = "flag";
	if(loggedin()){
		$class .= " flag_image_review";
		$query_2 = "SELECT * FROM `likes_spec_reviews` WHERE `review_id`='".$review_id."' AND `category`='".$category."' AND `item_id`='".$choice_id."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['flag']==1){
				$class .= " already_flagged_before_review";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}
?>