<?php require("Incs/sessionStart.inc.php"); ?>
<!doctype html>
<?php
$pageURL = 'http';
if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}

require("Incs/connect.inc.php");

$comparison_category = substr($pageURL, (strpos($pageURL, "info.php?="))+10, (((strpos($pageURL, "-")))-((strpos($pageURL, "info.php?="))+10))); 
$comparisonLength = strlen($comparison_category);
$choice_id = substr($pageURL, (strpos($pageURL, $comparison_category."-"))+$comparisonLength+1,
(((strpos($pageURL, "-c")))-((strpos($pageURL, $comparison_category."-"))+$comparisonLength+1)));

$query = "SELECT `Name`,`id` FROM `".$comparison_category."` WHERE `id`='".$choice_id."' AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
$choice_name = $query_row['Name'];
if(strpos($pageURL, "reviews")){
	$review_show = 1;
	$buy_show = 0;
} else if(strpos($pageURL, "buy")){
	$buy_show = 1;
	$review_show = 0;
} else {
	$review_show = 0;
	$buy_show = 0;
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54040025-1', 'auto');
  ga('send', 'pageview');

</script>
<title>WhichToPick: <?php echo $choice_name;?></title>
<meta name="description" content="<?php echo $choice_name.". The latest reviews, information and comparisons with other latest ".$comparison_category.". Post your own review and create your own comparisons and see how well ".$choice_name." does with other ".$comparison_catoegry; ?>" />
<meta name="keywords" content="<?php echo $comparison_category.", ".$choice_name.", "."Reviews, Comparisons, Buy";?>" />
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

$query = "UPDATE `".$comparison_category."` SET `pageViews_day`=`pageViews`+1, `pageViews_week`=`pageViews_week`+1, `pageViews_month`=`pageViews_month`+1, `pageViews`=`pageViews`+1 WHERE `id`='".mysql_real_escape_string($choice_id)."'";
$query_run = mysql_query($query);

// No Wins/Total Likes...
$choice_likes = 0;
$total_likes_possible = 0;
$wins = 0;
$query = "SELECT * FROM `compare` WHERE `choice_1`='".mysql_real_escape_string($choice_id)."' AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
for($x=1;$x<=$query_num_rows;$x++){
	$query_row = mysql_fetch_assoc($query_run);
	$choice_likes += $query_row['choice1_likes'];
	$total_likes_possible += $query_row['choice2_likes'];
	if ($query_row['choice1_likes'] > $query_row['choice2_likes'] ){
		$wins++;
	}
}
$query = "SELECT * FROM `compare` WHERE `choice_2`='".mysql_real_escape_string($choice_id)."' AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
for($x=1;$x<=$query_num_rows;$x++){
	$query_row = mysql_fetch_assoc($query_run);
	$choice_likes += $query_row['choice2_likes'];
	$total_likes_possible += $query_row["choice1_likes"];
	if ($query_row['choice2_likes'] > $query_row['choice1_likes'] ){
		$wins++;
	}
}
$total_likes_possible += $choice_likes;
switch($comparison_category){
	case "laptops":
		$field = array (
		"Name",
		"Brand",
		"Screen Size",
		"HDD",
		"Resolution",
		"Ram",
		"Processor",
		"Graphics Card"
		);
		$query_sd = "SELECT `id` FROM `laptops` WHERE (
		`".$field[1]."` LIKE '%".queryULT($field[1],$comparison_category,"id",$choice_id)."%' OR
		`".$field[2]."` LIKE '%".queryULT($field[2],$comparison_category,"id",$choice_id)."%' OR
		`".$field[3]."` LIKE '%".queryULT($field[3],$comparison_category,"id",$choice_id)."%' OR
		`".$field[4]."` LIKE '%".queryULT($field[4],$comparison_category,"id",$choice_id)."%' OR
		`".$field[5]."` LIKE '%".queryULT($field[5],$comparison_category,"id",$choice_id)."%' OR
		`".$field[6]."` LIKE '%".queryULT($field[6],$comparison_category,"id",$choice_id)."%' OR
		`".$field[7]."` LIKE '%".queryULT($field[7],$comparison_category,"id",$choice_id)."%') AND
		`".$field[0]."`!='".queryULT($field[0],$comparison_category,"id",$choice_id)."'
		AND `verified`='1' LIMIT 8";
		$ext = "/";
		$picType = "pic_name";
		break;
	case "games":
		$field = array (
		"Name", 
		"Genre",
		"Platforms",
		"Mode",
		"Released"
		);
		$query_sd = "SELECT `id` FROM `".$comparison_category."` WHERE (
		`".$field[1]."` LIKE '%".str_replace(',','%',mysql_real_escape_string(queryULT($field[1],$comparison_category,"id",$choice_id)))."%' OR
		`".$field[2]."` LIKE '%".str_replace(',','%',mysql_real_escape_string(queryULT($field[2],$comparison_category,"id",$choice_id)))."%' OR
		`".$field[3]."` LIKE '%".str_replace(',','%',mysql_real_escape_string(queryULT($field[3],$comparison_category,"id",$choice_id)))."%') AND
		`".$field[0]."`!='".mysql_real_escape_string(queryULT($field[0],$comparison_category,"id",$choice_id))."'
		AND `verified`='1' LIMIT 8";
		$ext = "/Icons/";
		$picType = "icon_img";
		break;
	case "phones":
		$field = array (
		"Name",
		"Brand",
		"Display",
		"Internal Storage",
		"Front Camera",
		"Rear Camera"
		);
		$query_sd = "SELECT `id` FROM `".$comparison_category."` WHERE (
		`".$field[1]."` LIKE '%".queryULT($field[1],$comparison_category,"id",$choice_id)."%' OR
		`".$field[2]."` LIKE '%".queryULT($field[2],$comparison_category,"id",$choice_id)."%' OR
		`".$field[3]."` LIKE '%".queryULT($field[3],$comparison_category,"id",$choice_id)."%' OR
		`".$field[3]."` LIKE '%".queryULT($field[3],$comparison_category,"id",$choice_id)."%' OR
		`".$field[5]."` LIKE '%".queryULT($field[5],$comparison_category,"id",$choice_id)."%') AND
		`".$field[0]."`!='".queryULT($field[0],$comparison_category,"id",$choice_id)."'
		AND `verified`='1' LIMIT 8";
		$ext = "/";
		$picType = "pic_name";
		break;
}

// SIDE LAPTOPS
$SL_id = array();
$x = 0;
$query_run = mysql_query($query_sd);
while ($query_row = mysql_fetch_assoc($query_run)){
	$SL_id[$x] = $query_row['id'];
	$x++;
}
$BuyLinks = "";
$BuyQuery = "SELECT `Buy Link`, `id` FROM `".$comparison_category."` WHERE `id`='".$choice_id."'";
$RunBuyQuery = mysql_query($BuyQuery);
$RunBuyQueryRow = mysql_fetch_assoc($RunBuyQuery);
$BuyLinks = $RunBuyQueryRow["Buy Link"];
$BuyingAmazon = array();

if($BuyLinks!=""){
	if (strpos($BuyLinks, ",") == true){
		$last_place = 0;
		$new_place = 0;
		$find = ",";
		$find_length = strlen($find);
		$x_times = substr_count($BuyLinks, $find);
		for ($x2=0;$x2<=$x_times; $x2++){
			$last_place = $new_place;
			$new_place = (strpos($BuyLinks, $find, $new_place)) + ($find_length);
			$difference = (($new_place-$last_place)-$find_length);
			if ($difference < 0){
				$difference = (strlen($BuyLinks)-($new_place));
			}
			$BuyingAmazon[$x2] = substr($BuyLinks, $last_place, $difference);
		}
	} else {
		$BuyingAmazon[0] = $BuyLinks;
	}
}

$query = "SELECT * FROM `spec_reviews` WHERE `item_id`='".$choice_id."' AND `category`='".$comparison_category."' AND `user_added_id`='1' AND `user`='ADMIN' ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$review = $review_id = $user_review = $user_reviewId = $time_review = $review_likes = $review_dislikes = array();
$x = 0;
while($query_row = mysql_fetch_assoc($query_run)){
	$review[$x] = $query_row['review'];
	$review_id[$x] = $query_row['id'];
	$user_review[$x] = $query_row['user'];
	$user_reviewId[$x] = $query_row['user_added_id'];
	$time_review[$x] = $query_row['time_added'];
	$review_likes[$x] = $query_row['likes'];
	$review_dislikes[$x] = $query_row['dislikes'];
	$x++;
}
$query = "SELECT * FROM `spec_reviews` WHERE `item_id`='".$choice_id."' AND `category`='".$comparison_category."' AND `user_added_id`!='1' AND `user`!='ADMIN' ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$x = (count($user_review));
while($query_row = mysql_fetch_assoc($query_run)){
	$review[$x] = $query_row['review'];
	$review_id[$x] = $query_row['id'];
	$user_review[$x] = $query_row['user'];
	$user_reviewId[$x] = $query_row['user_added_id'];
	$time_review[$x] = $query_row['time_added'];
	$review_likes[$x] = $query_row['likes'];
	$review_dislikes[$x] = $query_row['dislikes'];
	$x++;
}
if((isset($_POST['review_section_specAdminLink']) && !empty($_POST['review_section_specAdminLink']))&&
(isset($_POST['review_section_specAdminFrom']) && !empty($_POST['review_section_specAdminFrom']))&&
(isset($_POST['review_section_specAdminRating']) && !empty($_POST['review_section_specAdminRating']))&&
(isset($_POST['review_section_specAdmin']) && !empty($_POST['review_section_specAdmin']))){
	$OtherReview = mysql_real_escape_string(htmlentities($_POST['review_section_specAdmin']));
	$linkToReview = mysql_real_escape_string(htmlentities($_POST['review_section_specAdminLink']));
	$FromReview= mysql_real_escape_string(htmlentities($_POST['review_section_specAdminFrom']));
	$RatingReview = (mysql_real_escape_string(htmlentities($_POST['review_section_specAdminRating'])))."/10";
	$review_new = '<span style="font-style:italic;">'.$FromReview.'</span> - "'.$OtherReview
	.'"<span style="font-size:13px; color:green;"> '.$RatingReview
	.'</span> <a href="'.$linkToReview.'" target="_blank" style="color:orange; font-size:14px;">[See More]</a>';
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


require("Incs/Details/details_functions.inc.php");
?>

<input type="hidden" readonly="true" value="<?php echo $choice_id;?>"  id="choice_id"/>
<input type="hidden" readonly="true" value="<?php echo $choice_name;?>"  id="choice_name"/>
<input type="hidden" readonly="true" value="<?php echo $comparison_category;?>"  id="choice_category"/>
<input type="hidden" readonly="true" value="<?php echo $review_show;?>"  id="review_show"/>
<input type="hidden" readonly="true" value="<?php echo $buy_show;?>"  id="buy_show"/>
<div style="float:left; position:relative; top:10px; left:10px;">
<table style="position:relative; border:1px solid #CCCCCC; width:670px;background-color:#F5F5F5; vertical-align:text-top; border-collapse:collapse; border-spacing:0">
	<tr style=" border:1px solid #CCCCCC;padding:10px;max-height:450px; height:450px;width:666px;" ><!-- PICS -->
		<td colspan="2"style="padding:10px; background-color:#F5F5F5;">
			<div style=" position:relative; margin-left:auto;margin-right:auto;">
				<img class="pics"id="detail_pic"style=" max-height:430px; max-width:646px;border:1px solid #CCCCCC; background-color:white; margin:auto; margin-left:auto; margin-right:auto; display:table-cell; vertical-align: middle; horizontal-align:middle;"
				src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT('pic_name',$comparison_category,"id",$choice_id);?>"/>
			</div>
		</td>
	</tr> 
	<tr><!-- TABLE OPTIONS -->
		<td colspan="2" style="padding:10px;">
			<table style="border-collapse:collapse; width:647px; border-spacing:0;">
				<tr style="">
					<td style="text-align:center; width:216px; cursor:pointer;">
						<div id="detail_info"style="border-top-left-radius:5px; background-color:#E9E9E9;border:1px solid #C4C4C4; position:relative; margin-right:-3px;
						padding-bottom:3px; padding-top:3px;">
							Information
						</div>
					</td>
					<td style="text-align:center; width:215px; cursor:pointer;">
						<div id="detail_comparisons"style="border:1px solid #C4C4C4; background-color:#E9E9E9;
						padding-bottom:3px; padding-top:3px;">
							Likes
						</div>
					</td>
					<td style="text-align:center; width:216px; cursor:pointer; ">
						<div id="detail_review"style="border:1px solid #C4C4C4; background-color:#E9E9E9; margin-left:-3px;
						padding-bottom:3px; padding-top:3px;">
							Reviews
						</div>
					</td>
					<td style="text-align:center; width:216px; cursor:pointer; ">
						<div id="detail_buy"style="border-top-right-radius:5px; background-color:#E9E9E9;border:1px solid #C4C4C4; position:relative; margin-left:-3px;
						padding-bottom:3px; padding-top:3px;">
							Buy
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr id="detail_info_tr"style="border:1px solid #CCCCCC; padding:10px; height:340px;"><!-- INFORMATION -->
		<td colspan="2"style="vertical-align:text-top;border-collapse:collapse; padding-left:10px; padding-right:10px; padding-bottom:10px; padding-top:10px;">
			<div class="vertical_scroll" style="max-height:316px; border:1px solid #CCCCCC;">
			<div style="bottom-border:1px solid #CCCCCC:">
			<table class="details" style=" width:100%; border-collapse:collapse; vertical-align:text-top;background-color:white; ">
				<form action="<?php echo $pageURL;?>" method="POST" id="details_changes_form">
				<?php for ($x=0;$x<(count($field));$x++){ ?>
				<tr style="<?php if (($x+1)!=count($field)){echo 'border-bottom:1px solid #CCCCCC;';}?>vertical-align:text-top;" class="details_row details_tr">
					<td style="width:100px;vertical-align:text-top; " class="details_info_row">
						<div style="height:35px;">
							<div style="position:relative; top:7px; left:10px; font-size:18px;">
								<?php echo $field[$x];?>
							</div>
						</div>
					</td>
					<td style="width:465px;vertical-align:text-top; " class="details_info_row">
						<div style="overflow-y:hidden;">
							<div style="position:relative; top:7px; left:10px; font-size:16px; width:455px; margin-bottom:13px;">
								<?php echo queryULT($field[$x],$comparison_category,"id",$choice_id);?>
							</div>
						</div>
					</td>
				</tr>
				<?php } ?>
				</form>
			</table>
			</div>
			</div>
		</td>
	</tr>
	<tr id="detail_comparisons_tr" style="border:1px solid #CCCCCC; padding:10px; height:340px;"><!-- LIKES -->
		<td colspan="2"style="vertical-align:text-top;border-collapse:collapse; padding-left:10px; padding-right:10px; padding-bottom:10px; padding-top:10px;">
			<table class="details" style=" width:100%; border-collapse:collapse; border:1px solid #CCCCCC;vertical-align:text-top;background-color:white; ">
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						Number of Comparisons
					</td>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<?php echo $no_comparisons." - "
						."<a href='search.php?search_choice=comparison&search=".$choice_name."' style='font-size:12px; color:#4D4D4D; font-style:italic;'>
							View All Comparisons
						</a>"; ?>
					</td>
				</tr>
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						Number of likes total
					</td>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<?php echo $likes_total."/".($likes_totalAg+$likes_total)
						." <span style='font-size:12px; text-alight:right; vertical-align:text-bottom;";
						if($likes_total_percentage>50){
							echo "color:#1DAC1D;";
						} else if ($likes_total_percentage<50){
							echo " color:red";
						} else if ($likes_total_percentage==50){
							echo "color:RoyalBlue";
						}
						echo "'>(".
						$likes_total_percentage."%"
						.")</span>"; ?>
					</td>
				</tr>
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						Number of likes by users only
					</td>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<?php echo $likes_users."/".($likes_usersAg+$likes_users)
						." <span style='font-size:12px; text-alight:right; vertical-align:text-bottom;";
						if($likes_users_percentage>50){
							echo "color:#1DAC1D;";
						} else if ($likes_users_percentage<50){
							echo " color:red";
						} else if ($likes_users_percentage==50){
							echo "color:RoyalBlue";
						}
						echo "'>(".
						$likes_users_percentage."%"
						.")</span>"; ?>
					</td>
				</tr>
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						Number of likes by public
					</td>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<?php echo $likes_public."/".($likes_publicAg+$likes_public)
						." <span style='font-size:12px; text-alight:right; vertical-align:text-bottom; color:red;";
						if($likes_public_percentage>50){
							echo "color:#1DAC1D;";
						} else if ($likes_public_percentage<50){
							echo " color:red";
						} else if ($likes_public_percentage==50){
							echo "color:RoyalBlue";
						}
						echo "'>(".
						$likes_public_percentage."%"
						.")</span>"; ?>
					</td>
				</tr>
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						Number of wins
					</td>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<?php echo $noWins."/".$no_comparisons."<span style='font-size:12px; text-alight:right; vertical-align:text-bottom;";
						if($wins_total_percentage>50){
							echo "color:#1DAC1D;";
						} else if ($wins_total_percentage<50){
							echo " color:red";
						} else if ($wins_total_percentage==50){
							echo "color:RoyalBlue";
						}
						echo "'>(".
						$wins_total_percentage."%"
						.")</span>"; ?>
					</td>
				</tr>					
			</table>
		</td>
	</tr>
	<tr id="detail_reviews_tr" style="border:1px solid #CCCCCC; padding:10px; height:340px;"><!-- REVIEWS -->
		<td colspan="2"style="vertical-align:text-top;border-collapse:collapse; padding-left:10px; padding-right:10px; padding-bottom:10px; padding-top:10px;">
			<table class="details" style=" width:100%; border-collapse:collapse;height:315px; border:1px solid #CCCCCC;vertical-align:text-top;background-color:white; ">
				<tr>
					<td style="border-collapse:collapse; border-spacing:0; border-bottom:1px solid #CCCCCC;">
						<div class="review_scroll horizontal_scroll" style="height:320px; width:646px; margin-top:-1px; margin-left:-1px; margin-right:-1px; margin-bottom:-2px;">
						<table style="border-spacing:0;border-collapse:collapse;">
							<?php for($x=0; $x<count($review); $x++){ ?>
								<tr style="border-bottom:1px solid #CCCCCC;" class="review_row">
									<?php if($user_review[$x]!="ADMIN" && $user_reviewId[$x]!="1"){ ?>
										<input type="hidden" readonly="true" value="<?php echo $review_id[$x];?>"  class="review_id"/>
										<td style="padding:10px; width:626px;" class="review_given details_tr_td ">
											<?php echo $review[$x].
											" - <span style='font-style:italic; font-size:13px;'>".$user_review[$x]."</span>";?>
											<div class="details_options" style="display:inline-block; float:right; height:15px;">
											
												<span style="position:relative; top:3px;">
													<img class="<?php likeReview($review_id[$x], $choice_id, $comparison_category);?>"src="Pictures/Website/thumbs_up.png" style="height:15px;"/>
													<?php if (loggedin()){?>
													<img class="already_liked_review" src="Pictures/Website/green_thumbs_up.png" height="15px"/>
													<?php } ?>	
												</span>
												<span style="font-size:11px; color:#4d4d4d;">
												<?php echo $review_likes[$x];?>
												</span>
												
												<span style="position:relative; left:5px;">
												
												<span style="position:relative;">
												<img class="<?php flagReview($review_id[$x], $choice_id, $comparison_category);?>" src="Pictures/Website/flag.png" height="15px"/>
												<?php if (loggedin()){?>
												<img class="already_flagged_review" src="Pictures/Website/red_flag.png" height="15px"/>
												<?php } ?>
												</span>
												
												</span>
												
											</div>
										</td>
									<?php } else {?>
									<td style="padding:10px; width:626px;" class="detailsAdminReview ">
										<?php echo $review[$x];?>
									</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</table>
						</div>
					</td>
				</tr>
				<?php if (loggedin()){?>
					<?php if(($_SESSION["user_username"]!="ADMIN")&&($_SESSION["user_id"]!='1')){ ?>
						<form action="<?php echo curPageUrl() ;?>" method="POST">
						<tr id="post_review_button" style="height:30px; background-color:#F5F5F5;">
							<td style="width:100%; text-align:right;">
								<div class="hover_button"style="width:150px; height:25px; float:right; border-radius:3px; text-align:center; vertical-align:center; color:#4D4D4D;border:1px solid #C4C4C4;">Post A Review</div>
							</td>
						</tr>
						<tr class="review_section_post">
							<td colspan="1" style="background-color:#E9E9E9; padding:10px;padding-bottom:0; border-top:1px solid #CCCCCC;">
							<textarea style="width:618px;resize:none; height:147px;" name="review_section_spec" 
							placeholder="Your Review..."></textarea>
							</td>
						</tr>
						<tr class="review_section_post"style="background-color:#E9E9E9;">
							<td style="background-color:#E9E9E9; text-align:right; padding:10px; padding-top:0; width:57px; max-width:57px;">
								<img class="review_section_up" src="Pictures/Website/down_2.png" height="15px" style="padding-right:10px;"/>
								<input type="submit"/>
							</td>
						</tr>
						</form>
					<?php } else { ?>
						<form action="<?php echo curPageUrl() ;?>" method="POST">
						<tr id="post_review_button" style="height:30px; background-color:#F5F5F5;">
							<td style="width:100%; text-align:right;">
								<div class="hover_button"style="width:150px; height:25px; float:right; border-radius:3px; text-align:center; vertical-align:center; color:#4D4D4D;border:1px solid #C4C4C4;">Post A Review</div>
							</td>
						</tr>
						<tr class="review_section_post">
							<td colspan="1" style="background-color:#E9E9E9; padding:10px;padding-bottom:0; border-top:1px solid #CCCCCC;">
							From: <input style="width:580px;resize:none; height:20px;" name="review_section_specAdminFrom"/>
							</td>
						</tr>
						<tr class="review_section_post">
							<td colspan="1" style="background-color:#E9E9E9; padding:10px;padding-bottom:0;">
							<textarea style="width:618px;resize:none; height:147px;" name="review_section_specAdmin" 
							placeholder="Your Review..."></textarea>
							</td>
						</tr>
						<tr class="review_section_post">
							<td colspan="1" style="background-color:#E9E9E9; padding:10px;padding-bottom:0;">
							Link: <input style="width:586px;resize:none; height:20px;" name="review_section_specAdminLink"/>
							</td>
						</tr>
						<tr class="review_section_post">
							<td colspan="1" style="background-color:#E9E9E9; padding:10px;padding-bottom:0;">
							Rating: <input style="width:575px;resize:none; height:20px;" name="review_section_specAdminRating"/>
							</td>
						</tr>
						<tr class="review_section_post"style="background-color:#E9E9E9;">
							<td style="background-color:#E9E9E9; text-align:right; padding:10px; padding-top:0; width:57px; max-width:57px;">
								<img class="review_section_up" src="Pictures/Website/down_2.png" height="15px" style="padding-right:10px;"/>
								<input type="submit"/>
							</td>
						</tr>
						</form>
					<?php } ?>
				<?php } else {?>
				<tr style="height:30px;">
					<td style="background-color:#E9E9E9; padding:10px; border-top:1px solid #CCCCCC;">
						You need to be logged in to post reviews <a class="link_login">Log in</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
	<tr id="detail_buy_tr" style="border:1px solid #CCCCCC; padding:10px; height:340px;"><!-- BUYING -->
		<td colspan="2"style="vertical-align:text-top;border-collapse:collapse; padding-left:10px; padding-right:10px; padding-bottom:10px; padding-top:10px;">
			<table class="details" style=" width:100%; border-collapse:collapse; border:1px solid #CCCCCC;vertical-align:text-top;background-color:white; ">
				<tr>
					<td style="padding:8px; border:1px solid #CCCCCC;">
						<table>
							<?php 
							if((count($BuyingAmazon))==0){
								echo "Sorry, there are no currently no links to buy from.";
							} else {
								for($x=1; $x<=count($BuyingAmazon); $x++){
									?>
										<?php if ((($x-1)%5)==0){ echo "<tr>"; }?>
												<td valign="top">
													<div style="width:124px; height:250px;">
													<?php echo $BuyingAmazon[$x-1];?>
													</div>
												</td>
											<?php if (((($x%5)==0)) || ($x==count($BuyingAmazon))){ echo "</tr>"; }?>
										
									<?php
								}
							} ?>
						</table>
					</td>
				</tr>		
			</table>
		</td>
	</tr>
</table>
</div>

<div style="position:relative; float:right; top:10px; right:10px;"><!-- SIDE BOX -->
<div style="position:relative;">
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-8679411009445717";
	/* compareAd2 */
	google_ad_slot = "4911146381";
	google_ad_width = 300;
	google_ad_height = 250;
	//-->
	</script>
	<script type="text/javascript"
	src="//pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
</div>
<table style="position:relative; top:12px;border:1px solid #CCCCCC; max-width:372px; border-collapse:collapse; border-spacing: 0;">
	<tr style="background-color:#E9E9E9;">
		<td colspan="2" style="padding-left:10px;" id="test">
			Recommended
		</td>
	</tr>
	<?php $y = 1;
	for($x=0; $x<count($SL_id); $x++){
	?>
	<tr>
		<td  style="border:1px solid #CCCCCC; padding-top:5px; padding-left:5px; padding-right:5px; border-collapse:collapse;" >
			<table style="margin-left:auto; margin-right:auto; border-collapse:collapse; border-spacing:0;" class="comparison_select">
				<tr >
					<td>
						<div class="recommendedWrapper">
						<a href="details_info.php?=<?php echo $comparison_category."-".$SL_id[$x]."-c"?>">
							<img style="width:135px;" src="Pictures/<?php echo ucfirst($comparison_category).$ext.queryULT($picType,$comparison_category,"id",$SL_id[$x]);?>" >
						</a>
						</div>
					</td>
				</tr>
				<tr style="border-collapse:collapse;">
					<td style="border-collapse:collapse;">
						<table class="game_details" id="table_details" style="position:absolute; margin-top:2px;background-color:#E9E9E9;border:1px solid #CCCCCC; border-collapse:collapse; border-spacing:0px; margin-left:-7px;">
							<?php for ($x2=0;$x2<(count($field));$x2++){ ?>
								<tr style="border-collapse:collapse;">
									<td style="width:100px;border-collapse:collapse;"> <?php echo $field[$x2];?>  </td>
									<td style="width:166px;border-collapse:collapse;"><?php echo queryULT($field[$x2],$comparison_category,"id",$SL_id[$x]);?></td>
								</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<?php $x++;?>
		<td  style="border:1px solid #CCCCCC; max-height:110px; padding-top:5px; padding-left:5px; padding-right:5px;">
			<table style="margin-left:auto; margin-right:auto; border-collapse:collapse; border-spacing:0;" class="comparison_select">
				<tr >
					<td>
						<div class="recommendedWrapper2">
						<a href="details_info.php?=<?php echo $comparison_category."-".$SL_id[$x]."-c"?>">
							<img style="width:134px;" src="Pictures/<?php echo ucfirst($comparison_category).$ext.queryULT($picType,$comparison_category,"id",$SL_id[$x]);?>" >
						</a>
						<div>
					</td>
				</tr>
					<tr>
						<td>
							<table class="game_details" id="table_details" style="position:absolute; margin-top:2px;background-color:#E9E9E9;border:1px solid #CCCCCC; border-collapse:collapse; border-spacing:0px; margin-left:-156px;">
								<?php for ($x2=0;$x2<(count($field));$x2++){ ?>
									<tr >
										<td width="100px; max-width:100px;"> <?php echo $field[$x2];?>  </td>
										<td width="166px; max-width:166px;">
											<?php echo queryULT($field[$x2],$comparison_category,"id",$SL_id[$x]);?>
										</td>
									</tr>
								<?php } ?>
							</table>
						</td>
					</tr>
			</table>
		</td>
	</tr>
	<?php
	$y++; }
	?>
</table>
</div>

</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/details.inc.js"></script>
</body>
</html>