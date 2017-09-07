<?php 
function likeCommentCompare($id, $category){
	$class = "thumbs_up";
	if(loggedin()){
		$class .= " thumb_up_comment_comp";
		$query_2 = "SELECT * FROM `likes_comments_compare` WHERE `comment_id`='".$id."' AND `category`='".$category."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['like']==1){
				$class .= " already_liked_before_comment_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}

function dislikeCommentCompare($id, $category){
	$class = "thumbs_down";
	if(loggedin()){
		$class .= " thumb_down_comment_comp";
		$query_2 = "SELECT * FROM `likes_comments_compare` WHERE `comment_id`='".$id."' AND `category`='".$category."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['dislike']==1){
				$class .= " already_disliked_before_comment_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}

function flagCommentCompare($id, $category){
	$class = "flag";
	if(loggedin()){
		$class .= " flag_comment_comp";
		$query_2 = "SELECT * FROM `likes_comments_compare` WHERE `comment_id`='".$id."' AND `category`='".$category."' AND `user`='".$_SESSION['user_username']."'";
		$query_run_2 = mysql_query($query_2);
		$query_num_rows_2 = mysql_num_rows($query_run_2);
		if($query_num_rows_2 > 0){
			$query_row_2 = mysql_fetch_assoc($query_run_2);
			if($query_row_2['flag']==1){
				$class .= " already_flagged_before_comment_comp";
			}
		}
	} else {
		$class .= " nseed_login";
	}
	echo $class;
}

$query = "SELECT * FROM `comments` WHERE `compare_id`='".$compare_id."' AND `category`='".$comparison_category."' ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$x=0;
?>
<div style="position:relative; left:0px; padding:0px; width:672px;"> <!--background-color:#ECECEC;-->
<div style="font-size:22px; width:660px;"class="results_heading_2"><?php echo $compare_choice1_name."<span style='color:orange;'> vs </span>". $compare_choice2_name." comments";?></div>
<table style="border-collapse:collapse; min-width:672px;border-spacing:0; border:1px solid #CCCCCC; position:relative; top:10px;">
<?php if (loggedin()){ ?>
	<form action="<?php echo $pageURL;?>" method="POST"> <!-- AUTOSIZE -->
	<tr>
		<td style="padding:10px;padding-bottom:2px;background-color:#E9E9E9;">
		<textarea style="resize:none; height:125px; width:644px;" name="comment_section" placeholder="Please make your comments no longer than 600 characters..."></textarea>
		</td>
	</tr>
	<tr>
		<td style="text-align:right; background-color:#E9E9E9;">
		<input type="submit" value="Send"/>
		</td>
	</tr>
	</form>
	<?php } else { ?>
	<tr>
		<td style="padding-top:5px;padding-bottom:5px;padding-left:10px; padding-right:10px;background-color:#E9E9E9;"> 
		You need to be logged in to comment <a class="link_login">Log in</a>
		</td>
	</tr>
<?php } ?>
<?php
while ($query_row = mysql_fetch_assoc($query_run)){
$id = $query_row["id"];
$likes = $query_row["likes"];
$time = $query_row["time_added"];
$timeAgo = time() - $time;
$displayed_date = date('l jS F g:ia Y',$time);
$user = $query_row['user'];
?>
	<tr style="border:1px solid #CCCCCC; border-bottom:1px solid #707070;">
	<td>
		<table style="padding:10px; background-color:white; border-collapse:collapse; ">
		<tr>
			<td style="padding:14px;">
				<table style="border-collapse:collapse;">
					<tr>
						<input type="hidden" readonly="true" value="<?php echo $id;?>"  class="comment_id"/>						
						<td style="width:600px;">
							<a href="user.php?=<?php echo $query_row['user'];?>-user" style="text-decoration:none; color:black;">
								<?php echo $query_row["user"];?>
							</a>
						</td>
						<td style="margin-left:14px;">
							<img class="<?php likeCommentCompare($id,$comparison_category);?>" style="cursor: hand; cursor: pointer;" src="Pictures/Website/thumbs_up.png" height="15px"/>
							<?php if (loggedin()){?>
							<img class="already_liked_comment_comp" src="Pictures/Website/green_thumbs_up.png" height="15px"/>
							<?php } ?>
						</td>
						<td style="color:#4D4D4D; font-size:12px;">
							<?php echo "(".$likes.")";?>
						</td>
						<td>
							<img class="<?php flagCommentCompare($id,$comparison_category);?>" src="Pictures/Website/flag.png" height="15px"/>
							<?php if (loggedin()){?>
							<img class="already_flagged_comment_comp" src="Pictures/Website/red_flag.png" height="15px"/>
							<?php } ?>
						</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width:100%; padding:14px; padding-top:0;">
				<table style="width:100%;">
					<td>
						<a href="user.php?=<?php echo $query_row['user'];?>-view-user">
							<img id="user_img" src="Pictures/Users/<?php echo users_pic($user);?>" height="40"/>
						</a>
					</td>
					<td style="text-align:right;font-size:12px; font-style:italic;">
						<?php echo $displayed_date;?>
					</td>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=5 style=" border-top:1px solid #CCCCCC; padding:14px;">
			<span><?php echo $query_row["comment"]."</br>"; ?></span>
			</td>
		</tr>
		</table>
		</td>
	</tr>
<?php $x++; } ?>
</table>
</div>