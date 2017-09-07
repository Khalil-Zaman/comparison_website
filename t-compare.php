<?php require("Incs/sessionStart.inc.php"); ?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css">
<title>
WoTechno	
</title>
</head>
<body>
<div id="header_stretch"></div>
<div id="header_stretch_2"></div>
<div id="header">
	<div id="header_info">
		<?php
			require ("Incs/template.inc.php");
		?>
	</div>
</div>
<div id="wrapper">
<div id="wrapper_2">
<div id="content">
<?php
@$pageURL = curPageUrl();
@$comparison_category = substr($pageURL, (strpos($pageURL, "compare.php?"))+12, (((strpos($pageURL, "-c")))-((strpos($pageURL, "compare.php?"))+12)));
@$compare_comparison_url = substr($pageURL, (strpos($pageURL, "-c"))+2, (((strpos($pageURL, "-gc")))-((strpos($pageURL, "-c"))+2)));
@$compare_choice1_id = substr($pageURL, (strpos($pageURL, "-c"))+2, (((strpos($pageURL, "&&")))-((strpos($pageURL, "-c"))+2)));
@$compare_choice2_id = substr($pageURL, (strpos($pageURL, "&&"))+2, (((strpos($pageURL, "-gc")))-((strpos($pageURL, "&&"))+2)));
$query = "SELECT `id`,`user_added` FROM `compare` WHERE `pageURL` = '".$compare_comparison_url."' AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
$user_added = $query_row['user_added'];
$compare_choice1_name = queryULT("Name", $comparison_category, "id",$compare_choice1_id);
$compare_choice2_name = queryULT("Name", $comparison_category, "id",$compare_choice2_id);

$query = "SELECT `id`, `choice1_likes`, `choice2_likes`, `choice1_likes_public`, `choice2_likes_public`, `choice1_likes_users`, `choice2_likes_users`, `pageViews_day`, 
`pageViews_week`, `pageViews_month`, `pageViews`, `time_added`, `user_added`, `category` FROM `compare` 
WHERE `pageURL`='".$compare_comparison_url."' AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
$compare_id = $query_row["id"];
$choice1_likes_total = $query_row["choice1_likes"];
$choice2_likes_total = $query_row["choice2_likes"];
$choice1_likes_public = $query_row["choice1_likes_public"];
$choice2_likes_public = $query_row["choice2_likes_public"];
$choice1_likes_users = $query_row["choice1_likes_users"];
$choice2_likes_users = $query_row["choice2_likes_users"];
$pageViews = $query_row["pageViews"];
$pageViews_day = $query_row["pageViews_day"];
$pageViews_week = $query_row["pageViews_week"];
$pageViews_month = $query_row["pageViews_month"];
$pageViews++;
$pageViews_day++;
$pageViews_week++;
$pageViews_month++;
queryUPD("compare", "pageViews", $pageViews, "pageURL", $compare_comparison_url);
queryUPD("compare", "pageViews_day", $pageViews_day, "pageURL", $compare_comparison_url);
queryUPD("compare", "pageViews_week", $pageViews_week, "pageURL", $compare_comparison_url);
queryUPD("compare", "pageViews_month", $pageViews_month, "pageURL", $compare_comparison_url);
$query = "SELECT `id` FROM `compare` ORDER BY `id` DESC";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
$max_id = $query_row["id"];
if ($compare_id==$max_id){
	$next_id=1;
} else {
	$next_id = $compare_id;
	$next_id++;
}
$right_url = queryULT("pageURL", "compare","id",$next_id);
if ($compare_id==1){
	$before_id = $max_id;
} else {
	$before_id = $compare_id;
	$before_id--;
}
$left_url = queryULT("pageURL", "compare","id",$before_id);

//LIKE
if (loggedin()){
	$query = $query = "SELECT * FROM `likes` WHERE `username`='".$_SESSION['user_username']."'
	AND `category`='".$comparison_category."' AND `pageURL`='".$compare_comparison_url."'";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	if ($query_num_rows >= 1){
		$query_row = mysql_fetch_assoc($query_run);
		$left_thumb = $query_row['left'];
		$right_thumb = $query_row['right'];
	}
} else {
	if(isset($_SESSION[$comparison_category."_".$compare_comparison_url.'_left'])){
		$left_thumb = $_SESSION[$comparison_category."_".$compare_comparison_url.'_left'];
	} else {
		$left_thumb = '0';
	}
	if(isset($_SESSION[$comparison_category."_".$compare_comparison_url.'_right'])){
		$right_thumb = $_SESSION[$comparison_category."_".$compare_comparison_url.'_right'];
	} else {
		$right_thumb = '0';
	}
}
// SIDE LINKS
$side_1 = rand(1, $max_id);
if ($side_1 == $compare_id){
	if ($side_1 != $max_id){
		$side_1++;
	} else {
		$side_1--;
	}
}
$sd_choice1 =  queryULT("choice_1","compare","id",$side_1);
$sd_choice2 =  queryULT("choice_2","compare","id",$side_1);

// SIDE LINKS
$sd_choice1_id = array();
$sd_choice2_id = array();
$sd_choice1_name = array();
$sd_choice2_name = array();
$sd_url = array();
$side_1 = rand(1, $max_id);
if ($side_1 == $compare_id){
	if ($side_1 != $max_id){
		$side_1++;
	} else {
		$side_1--;
	}
}
$x = 0;
$query = "SELECT * FROM `compare` WHERE `category`='".$comparison_category."' AND (`choice_1`='".$compare_choice1_id."' 
OR `choice_2`='".$compare_choice1_id."' OR `choice_1`='".$compare_choice2_id."' OR `choice_2`='".$compare_choice2_id."') ORDER BY `id` DESC";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	if (($x+1) <= 2){
		$sd_choice1_id[$x] = $query_row["choice_1"];
		$sd_choice2_id[$x] = $query_row["choice_2"];
		$sd1_name =  queryULT("Name", $comparison_category,"id",$sd_choice1_id[$x]);
		$sd2_name = queryULT("Name", $comparison_category,"id",$sd_choice2_id[$x]);
		if($comparison_category=="laptops"){
			$sd1_brand = queryULT("Brand", $comparison_category,"id",$sd_choice1_id[$x]);
			$sd2_brand = queryULT("Brand", $comparison_category,"id",$sd_choice2_id[$x]);
			$sd_choice1_name[$x] = $sd1_brand."<br><span style='font-size:13px;'>".$sd1_name."</span>";
			$sd_choice2_name[$x] = $sd2_brand."<br><span style='font-size:13px;'>".$sd2_name."</span>";
		} else {
			$sd_choice1_name[$x] = $sd1_name;
			$sd_choice2_name[$x] = $sd2_name;
		}
		$sd_url[$x] = $query_row["pageURL"];
		$x++;
	}
}

// FIELD SPECIFIED ARRAYS
switch($comparison_category){
	case "laptops":
		$field = array (
		"Name",
		"Brand",
		"Screen Size",
		"HDD",
		"Resolution",
		"Ram",
		"Bluetooth",
		"Processor",
		"Price"
		);
		$pic_name = "pic_name";
		$ext = "/";
		$height = "327px";
		$heading = "Laptop";
		break;
	case "games":
		$field = array(
		"Name",
		"Platforms",
		"Genre"
		);
		$pic_name = "icon_img";
		$ext = "/Icons/";
		$height = "182px";
		$heading = "Game";
		break;
	case "phones":
		$field = array(
		"Name",
		"Brand",
		"Display",
		"Storage",
		"Front Camera",
		"Rear Camera"
		);
		$pic_name = "pic_name";
		$ext = "/";
		$height = "327px";
		$heading = "Phone";
		break;
}
?>
<?php // TOP COMPARISON MADE
$x = 0;
$x2 = 0;
$x2_w = 0;
$pageURLArray = array();
$choice1 = array();
$choice2 = array();
$choice1_name = array();
$choice2_name = array();
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."'ORDER BY `pageViews_day` DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while ($query_row = mysql_fetch_assoc($query_run)){	
	if (($x+1) <= 5){
		$pageViews_day = $query_row["pageViews_day"];
		if ($pageViews_day != 0){
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $pageURLArray)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$choice1[$x] =  $query_row["choice_1"];
			$choice2[$x] =  $query_row["choice_2"];
			$choice1_name[$x] = queryULT("Name", $comparison_category, "id",$choice1[$x]);
			$choice2_name[$x] = queryULT("Name", $comparison_category, "id",$choice2[$x]);
			if($comparison_category=="laptops"){
				$choice1_brand[$x] = queryULT("Brand", $comparison_category, "id",$choice1[$x]);
				$choice2_brand[$x] = queryULT("Brand", $comparison_category, "id",$choice2[$x]);
			} else {
				$choice1_brand[$x] = "";
				$choice2_brand[$x] = "";
			}
		} else {
			$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `id` DESC ";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			while ($x2_w<=$x2){
				$query_row = mysql_fetch_assoc($query_run);
				$x2_w++;
			}
			$pageURL = $query_row["pageURL"];
			while((in_array($pageURL, $pageURLArray)) || in_array($pageURL, $sd_url)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$choice1[$x] =  $query_row["choice_1"];
			$choice2[$x] =  $query_row["choice_2"];
			$choice1_name[$x] = queryULT("Name", $comparison_category, "id",$choice1[$x]);
			$choice2_name[$x] = queryULT("Name", $comparison_category, "id",$choice2[$x]);
			if($comparison_category=="laptops"){
				$choice1_brand[$x] = queryULT("Brand", $comparison_category, "id",$choice1[$x]);
				$choice2_brand[$x] = queryULT("Brand", $comparison_category, "id",$choice2[$x]);
			} else {
				$choice1_brand[$x] = "";
				$choice2_brand[$x] = "";
			}
			$x2_w = 0;
			$x2++;
		}	
		$pageURLArray[$x] = $pageURL;
		$x++;
	}
}
?>
<?php // TOP COMPARISONS CODE

require("Incs/CompareIncs/compare_likes.inc.php");
$comparison_category_ar = array();
$pageURL_ar_top = array();
$choice1_top = array();
$choice2_top = array();
$choice1_name_top = array();
$choice2_name_top = array();
$pageViews_day_ar_top = array();
$extension_top = array();
$pic_top = array();
$x = 0;
$place = 0;

$query = "SELECT `id`,`time_added`,`category`,`pageURL`,`choice_1`,`choice_2`,`pageViews_day` FROM `compare` WHERE  1 ORDER BY `pageViews_day` DESC LIMIT 30" ;
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$choice1_top[$x] =  $query_row["choice_1"];
	$choice2_top[$x] =  $query_row["choice_2"];
	$choice1_name_top[$x] = queryULT("Name",$query_row["category"], "id",$choice1_top[$x]);
	$choice2_name_top[$x] = queryULT("Name",$query_row["category"], "id",$choice2_top[$x]);
	$comparison_category_ar_top[$x] = $query_row["category"];
	$pageViews_day_ar_top[$x] = $query_row["pageViews_day"];
	$pageURL_ar_top[$x] = $query_row["pageURL"];
	if($comparison_category_ar_top[$x]=="games"){
		$extension_top[$x]="/Icons/";
		$pic_top[$x]="icon_img";
	} else {
		$extension_top[$x]="/";
		$pic_top[$x] = "pic_name";
	}
	$x++;	
}
?>

<input type="hidden" readonly="true" value="<?php echo $compare_comparison_url;?>"  id="comparison_url"/>
<input type="hidden" readonly="true" value="<?php echo $comparison_category;?>"  id="choice_category"/>
<div style="width:1000px;">
<div style="float:left; position:relative; top:10px; left:10px;">
<table style="position:relative; border:1px solid #CCCCCC; max-width:672px; border-collapse:collapse; border-spacing: 0;"><!-- COMPARISON -->
	<tr>
		<td colspan="3" style="border-bottom:1px solid #CCCCCC;">
			<table style="margin-left:auto; margin-right:auto;">
				<tr>
					<td colspan=2 id="pic" >
						<a href="<?php echo "details_info.php?=".$comparison_category."-".$compare_choice1_id."-c"?>">
							<img class="game_pic" src="Pictures/<?php echo $comparison_category."/".queryULT("pic_name",$comparison_category,"id",$compare_choice1_id);?>" width="323"/>
						</a>
					</td>
					<td colspan="2" >
						<div style="height:<?php echo $height;?>; background-color:green; width:1px; margin-top:-2px;"></div>
					</td>
					<td colspan=2 id="pic" >
						<a href="<?php echo "details_info.php?=".$comparison_category."-".$compare_choice2_id."-c"?>">
							<img class="game_pic" src="Pictures/<?php echo $comparison_category."/".queryULT("pic_name",$comparison_category,"id",$compare_choice2_id);?>" width="323"/>
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="3"style="text-align:center;color:black;"><?php echo $compare_choice1_name;?></td>
					<td colspan="3"style="text-align:center;color:black;"><?php echo $compare_choice2_name;?></td> 	
				</tr>
			</table>
		</td>
	</tr>
	<tr><!-- LEFT AND RIGHT ARROWS -->
		<td colspan="3" style="border-bottom:1px solid #CCCCCC;">
			<table style="width:100%;">
				<tr>
					<td colspan="1" style="text-align:left;">
						<a id="go_left" href="compare.php?<?php echo $comparison_category."-c".$left_url."-gc";?>">
							<img src="Pictures/Website/left.png" height="20px;"/>
						</a>
					</td>
					<td>
						<span style="font-style:italic; font-size:12px; color:#4D4D4D;">by</span><?php echo " ".$user_added;?>
					</td>
					<td colspan="1" style="float:right;">
						<a id="go_right" href="compare.php?<?php echo $comparison_category."-c".$right_url."-gc";?>">
							<img src="Pictures/Website/right.png" height="20px;" />
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td colspan="1" id="likes" style="width:33%; text-align:center; border-right:1px solid #CCCCCC;">Likes</td>
		<td colspan="1" id="details" style="width:33%; text-align:center;border-right:1px solid #CCCCCC;border-left:1px solid #CCCCCC;">Information</td>
		<td colspan="1" id="reviews" style="width:33%; text-align:center;border-left:1px solid #CCCCCC;">Reviews</td>
	</tr>
	<tr id="table_details">
		<td colspan="3" style="height:350px; background-color:white; vertical-align:text-top; border-collapse:collapse;">
			<div id="detail-scroll">
				<table  style="width:671px; border-collapse:collapse; margin-left:-1px; margin-top:-1px; background-color:white; top:0px;" >
					<?php for ($x=1;$x<=(count($field));$x++){ ?>
					<tr>
						<td style="width:10%;"> <?php echo $field[$x-1];?>  </td>
						<td style="width:40%; text-align:center; border-right:1px solid #CCCCCC"><?php echo queryULT($field[$x-1],$comparison_category,"id",$compare_choice1_id);?></td>
						<td style="width:40%; text-align:center;"><?php echo queryULT($field[$x-1],$comparison_category,"id",$compare_choice2_id);?></td>
						<td style="width:10%; text-align:right;"> <?php echo $field[$x-1];?>  </td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</td>
	</tr>
	<tr id="table_likes">
		<td colspan="3" style="height:350px; background-color:white; vertical-align:text-top; border-collapse:collapse;">
			<table  style="width:671px; border-collapse:collapse; margin-left:-1px; margin-top:-1px; background-color:white; top:0px;" >
				<tr>
					<td style="width:30%;">
						<strong>Which One?</strong>
					</td>
					<td style="width:20%; text-align:center; border-right:1px solid #CCCCCC">
						<img class="<?php likeComparisonLeft($left_thumb);?>" src="Pictures/Website/thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php if(loggedin()){?>
						<img class="already_liked_comparison_left_loggedin"src="Pictures/Website/green_thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php } else { ?>
						<img class="already_liked_comparison_left"src="Pictures/Website/green_thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php } ?>
					</td>
					<td style="width:20%; text-align:center;">
						<img class="<?php likeComparisonRight($right_thumb);?>"	src="Pictures/Website/thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php if(loggedin()){?>
						<img class="already_liked_comparison_right_loggedin"src="Pictures/Website/green_thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php } else { ?>
						<img class="already_liked_comparison_right"src="Pictures/Website/green_thumbs_up.png" style="height:18px; margin-left:-18px;"/>
						<?php } ?>
					</td>
					<td style="width:30%; text-align:right;">
						<strong>Which One?</strong>
					</td>
				</tr>
				<tr>
					<td style="width:30%;">
					Total Likes
					</td>
					<td style="width:20%; text-align:center; border-right:1px solid #CCCCCC">
						<div id="left_likes" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice1_likes_total;?></div>
					</td>
					<td style="width:20%; text-align:center;">
						<div id="right_likes" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice2_likes_total;?></div>
					</td>
					<td style="width:30%; text-align:right;">
					Total Likes
					</td>
				</tr>
				<tr>
					<td style="width:30%;">
					Total Likes By Users
					</td>
					<td style="width:20%; text-align:center; border-right:1px solid #CCCCCC">
						<div id="left_likes_user" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice1_likes_users;?></div>
					</td>
					<td style="width:20%; text-align:center;">
						<div id="right_likes_user" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice2_likes_users;?></div>
					</td>
					<td style="width:30%; text-align:right;">
					Total Likes By Users
					</td>
				</tr>
				<tr>
					<td style="width:30%;">
					Total Likes By Public
					</td>
					<td style="width:20%; text-align:center;  border-right:1px solid #CCCCCC">
						<div id="left_likes_public" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice1_likes_public;?></div>
					</td>
					<td style="width:20%; text-align:center;">
						<div id="right_likes_public" style="text-align:center; width:103px; max-width:103px;" ><?php echo $choice2_likes_public;?></div>
					</td>
					<td style="width:30%; text-align:right;">
					Total Likes By Public
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr id="table_reviews">
		<td colspan="3" style="height:350px; background-color:#E9E9E9; vertical-align:text-top; border-collapse:collapse; border-spacing:0;" >
			<table style="width:671px; border-collapse:collapse; border-spacing:0;margin-left:-1px; 
			margin-top:-1px;top:0px; height:350px; background-color:white;">
				<tr>
					<td style="padding-left:10px; padding-top:10px;">
						<a href="<?php echo "details_info.php?=".$comparison_category."-".$compare_choice1_id."-c-reviews"?>" style="text-decoration:none; color:#4D4D4D;">
							<div style="background-color:#E9E9E9; margin-right:-2px; border:1px solid #CCCCCC; padding:5px; text-align:center;">
								View Reviews
							</div>
						</a>
					</td>
					<td style="padding-right:10px; padding-top:10px;">
						<a href="<?php echo "details_info.php?=".$comparison_category."-".$compare_choice2_id."-c-reviews"?>" style="text-decoration:none; color:#4D4D4D;">
							<div style="background-color:#E9E9E9; margin-left:-1px; border:1px solid #CCCCCC; padding:5px; text-align:center;">
								View Reviews
							</div>
						</a>
					</td>
				</tr>
				<tr>
					<td style="padding:10px;" colspan="2">
						<div style="border-bottom:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
						<div class="review_scroll horizontal_scroll" style="margin-top:-1px; margin-bottom:-1px; overflow-x:hidden;">
						<table style="border:1px solid #CCCCCC; border-collapse:collapse;">
						<?php 
						if (count($reviewComp)>0){
						for($x=0; $x<count($reviewComp); $x++){
						?>
							<tr class="row_likes">
								<td>
									<div style="position:relative; left:9px; top:9px;">
									<div class="details_info_row1">
										<img class="<?php likeReviewComp ($comparison_category, $compare_comparison_url, $reviewId[$x]);?>" src="Pictures/Website/thumbs_up.png" height="15px"/>
										<?php if (loggedin()){?>
										<img class="already_liked_review_comp" src="Pictures/Website/green_thumbs_up.png" height="15px"/>
										<?php } ?>
									</div>
									<div class="details_info_row1">
										<?php echo $reviewLikes[$x];?>
									</div>
									<div class="details_info_row1">
										<img class="<?php dislikeReviewComp ($comparison_category, $compare_comparison_url, $reviewId[$x]);?>" src="Pictures/Website/thumbs_down.png" height="15px"/>
										<?php if (loggedin()){?>
										<img class="already_disliked_review_comp" src="Pictures/Website/red_thumbs_down.png" height="15px"/>
										<?php } ?>
									</div>
									<div class="details_info_row1">
										<?php echo $reviewDislikes[$x];?>
									</div>
									<div class="details_info_row1">
										<img class="<?php flagReviewComp($comparison_category, $compare_comparison_url, $reviewId[$x]);?>" src="Pictures/Website/flag.png" height="15px"/>
										<?php if (loggedin()){?>
										<img class="already_flagged_review_comp" src="Pictures/Website/red_flag.png" height="15px"/>
										<?php } ?>
									</div>
									</div>
								</td>
							</tr>
							<tr style="border-bottom:1px solid #CCCCCC;" class="row">
								<input type="hidden" readonly="true" value="<?php echo $reviewId[$x];?>"  class="review_id"/>							
								<td colspan="1" class="row_colspan">
									<?php echo $reviewComp[$x]."<span style='font-size:12px;'> - by ".$reviewUser[$x]."</span>";?>
									<img src="Pictures/Website/more_3.png" style="max-height:14px; max-width:14px; cursor:pointer;" class="reviewMoreOptions"/>
								</td>
							</tr>
						<?php }}	?>
						</table>
						</div>
						</div>
					</td>
				</tr>
				<?php if (loggedin()){?>
				<form action="<?php echo curPageUrl() ;?>" method="POST">
				<tr style="height:30px;">
					<td style="width:100%; text-align:right;" colspan="2">
						<input type="button" value="Post A Review" id="post_review_button" >
					</td>
				</tr>
				<tr class="review_section_post" style="background-color:#F2F2F2; height:168px; border-top:1px solid #CCCCCC;">
					<td colspan="2" style="background-color:#F2F2F2; padding:10px; padding-bottom:0;">
					<textarea style="width:645px;resize:none; height:147px;" name="review_section" 
					placeholder="Please make your reviews no longer than 200 characters."></textarea>
					</td>
				</tr>
				<tr class="review_section_post"style="background-color:#F2F2F2;">
					<td colspan="2" style="background-color:#F2F2F2; text-align:right; padding:10px; padding-top:0; width:57px; max-width:57px;">
						<img class="review_section_up" src="Pictures/Website/up_2.png" height="15px" style="padding-right:10px;"/>
						<input type="submit" value="Submit"/>
					</td>
				</tr>
				</form>
				<?php } else {?>
				<tr style="height:30px;background-color:#E9E9E9; padding:10px;">
					<td colspan="2" style="background-color:#E9E9E9; padding:10px; border-top:1px solid #CCCCCC; position:relative;">
						You need to be logged in to post reviews <a class="link_login">Log in</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>
<div style="position:relative; top:25px;"><!-- COMMENTS -->
<?php 
@$pageURL = curPageUrl();
switch($comparison_category){
	case "laptops":
		$query_compare_from = "laptops_compare_id";
		break;
	case "games":
		$query_compare_from = "games_compare_id";
		break;
	case "phones":
		$query_compare_from = "phones_compare_id";
		break;
}
$query_compare_to = $compare_id;
require("Incs/comment.inc.php");
require("Incs/comment_section.inc.php");?>
</div>
</div>

<div style="position:relative; float:right;top:10px; right:10px;">
<div style="position:relative; width:300px; height:250px; background-color:orange;"></div> <!-- MEDIUM RECTANGLE -->
	
	<div style="position:relative; top:25px;"><!-- TOP COMPARISONS LEAGUE TABLE -->
		<div style="background-color:#e9e9e9; position:relative; top:203px; border:1px solid #CCCCCC; padding-left:10px; padding-top:3px; padding-bottom:3px;width:288px; color:#4d4d4d;
		border-top-left-radius:5px; border-top-right-radius:5px;">
			Top Comparisons Today
		</div>
		<div id="table-scroll" style="height:504px; width:298px; position:relative; top:202px;border:1px solid #CCCCCC;">
			<table id="top_results" style="width:291px;">
			<?php
			for ($x = 0; ($x+1)<=30;$x++){
			?>
				<tr>
					<td class="position"><?php echo $x+1;?></td>
					<td class="top_results_comparison">
						<a  href="<?php echo "compare.php?".$comparison_category_ar_top[$x]."-c".$pageURL_ar_top[$x]."-gc";?>">
							<?php echo $choice1_name_top[$x]." <span style='color:orange;'>vs</span> ".$choice2_name_top[$x];?>
						</a>
					</td>
				</tr>
			<?php
			}
			?>
			</table>
		</div>
	</div>
	
	<div style="position:relative; top:-524px;"><!-- SLIDESHOW FOR TOP CATEGORY COMPARISONS -->
		<div style="background-color:#e9e9e9; position:relative; top:1px; border:1px solid #CCCCCC; padding-left:10px; padding-top:3px; padding-bottom:3px;width:288px; color:#4d4d4d;
		border-top-left-radius:5px; border-top-right-radius:5px;">
			Top <?php echo $heading;?> Comparison Today
		</div>
		<div style="position:relative; width:298px; border:1px solid #CCCCCC; padding-top:5px; padding-bottom:5px; top:156px;">
			<table style="margin-left:auto; margin-right:auto;">
				<tr>
					<td style="padding-left:10px; padding-right:10px;">
						<div class="circleTop" id="circle_1"></div>
					</td>
					
					<td style="padding-left:10px; padding-right:10px;">
						<div class="circleTop" id="circle_2"></div>
					</td>
					
					<td style="padding-left:10px; padding-right:10px;">
						<div class="circleTop" id="circle_3"></div>
					</td>
					
					<td style="padding-left:10px; padding-right:10px;">
						<div class="circleTop" id="circle_4"></div>
					</td>
					
					<td style="padding-left:10px; padding-right:10px;">
						<div class="circleTop" id="circle_5"></div>
					</td>
				</tr>
			</table>			
		</div>
		
		<div style="position:relative; border:1px solid #CCCCCC; top:-24px;" class="topSdComparison">
			<table style="position:relative; max-width:372px; border-collapse:collapse; border-spacing: 0;">
				<tr style="height:155px;">
					<?php for($x=0; $x<5; $x++){?>
					<td  style="max-height:110px; position:relative;width:288px;padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select sd_highlight" id="sd_<?php echo $x+1;?>">
						<a href="<?php echo "compare.php?".$comparison_category."-c".$pageURLArray[$x]."-gc";?>">
							<table style="margin-left:auto; margin-right:auto; height:148px;"  >
								<tr>
									<td>
										<img class="sd_comparisons" src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$choice1[$x]);?>">
									</td>
									<td>
										<div style="height:126px; background-color:green; width:1px;"></div>
									</td>
									<td>
										<img class="sd_comparisons" src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$choice2[$x]);?>">
									</td>
								</tr>
								<tr class="game_details sd_game_details" style="margin-top:5px; margin-left:-10px;">
									<td colspan="3" class="sd_comp_details" >
										<?php echo $choice1_name[$x];?>
									</td>
									<td colspan="3" class="sd_comp_details">
										<?php echo $choice2_name[$x]?>
									</td> 
								</tr>
							</table>
						</a>
					</td>
					<?php } ?>
				</tr>
			</table>
		</div>
	</div>

	<div>
		<table style="position:relative; border:1px solid #CCCCCC; top:30px; max-width:372px; border-collapse:collapse; border-spacing: 0;"><!-- SIDE LAPTOPS -->
			<tr style="background-color:#E9E9E9;">
				<td colspan="2" style="padding-left:10px; width:287px; color:#4d4d4d;">
					Recommended for you
				</td>
			</tr>
			<?php
			for($x=0; $x<count($sd_url); $x++){
			?>
			<tr>
				<td  style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select highlight_comparison" >
					<a href="compare.php?<?php echo $comparison_category."-c".$sd_url[$x]."-gc";?>">
					<table style="margin-left:auto; margin-right:auto;" >
						<tr >
							<td>
								<img class="sd_comparisons"src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$sd_choice1_id[$x]);?>" >
							</td>
							<td>
								<div style="height:126px; background-color:green; width:1px;"></div>
							</td>
							<td>
								<img  class="sd_comparisons"src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$sd_choice2_id[$x]);?>" >
							</td>
						</tr>
						<tr class="game_details sd_game_details" style="margin-top:1px; margin-left:-10px;">
							<td colspan="3" class="sd_comp_details" >
								<?php echo $sd_choice1_name[$x];?>
							</td>
							<td colspan="3" class="sd_comp_details">
								<?php echo $sd_choice2_name[$x];?>
							</td> 
						</tr>
					</table>
					</a>
				</td>
			</tr>
			<?php
			}
			?>
			<?php
			for($x=0; $x<count($pageURLArray); $x++){
			?>
			<tr>
				<td  style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select highlight_comparison" >
					<a href="compare.php?<?php echo $comparison_category."-c".$pageURLArray[$x]."-gc";?>">
					<table style="margin-left:auto; margin-right:auto;" >
						<tr >
							<td>
								<img class="sd_comparisons" src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$choice1[$x]);?>" >
							</td>
							<td>
								<div style="height:126px; background-color:green; width:1px;"></div>
							</td>
							<td>
								<img class="sd_comparisons" src="Pictures/<?php echo $comparison_category.$ext.queryULT($pic_name,$comparison_category,"id",$choice2[$x]);?>" >
							</td>
						</tr>
						<tr class="game_details sd_game_details" style="margin-top:1px; margin-left:-10px;">
							<td colspan="3" class="sd_comp_details">
								<?php echo $choice1_name[$x];?>
							</td>
							<td colspan="3" class="sd_comp_details">
								<?php echo $choice2_name[$x];?>
							</td> 
						</tr>
					</table>
					</a>
				</td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
	
</div>

</div>
</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/jq_compare.js"></script>
</body>
</html>