<?php require("Incs/sessionStart.inc.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54040025-1', 'auto');
  ga('send', 'pageview');

</script>
<title>WhichToPick: Laptops, Games & Phones - Reviews and Comparisons</title>
<meta name="description" content="WhichToPick offers you all you need to know about Laptops, Games & Phones. Compare items you can't decide between, and see what people have to say about between them to help you decide."/>
<meta name="keywords" content="Comparisons, Compare, Reviews, Games, Laptops, Phones"/>
</head>
<body onload="loaded()">
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
<?php // SEARCH COMPARISONS CODE
$num_comparisons_pp = 51;
@$pageURL = curPageUrl();
if(strpos($pageURL, "page=")){
	$page_number = substr($pageURL, (strpos($pageURL, "page="))+5);
} else {
	$page_number = 1;
}
$Search = false;
$pages_search = 0;
require('Incs/Incs/game_search_compare.inc.php');
require('Incs/Incs/laptops_search_compare.inc.php');
require('Incs/Incs/phones_search_compare.inc.php');
$update_time_daily = queryULT("time","updates","Update","Daily");
$daily_update_time = strtotime($update_time_daily);
$time_difference_daily = time() - $daily_update_time;
if ($time_difference_daily >= 86400){
	$date = date('Y-m-d 00:00:00', time());
	queryUPD("updates","Time",$date,"Update","Daily");
	$query = "UPDATE `compare` SET `pageViews_day`='0'";
	$query_run = mysql_query($query);
}

$update_time_weekly = queryULT("time","updates","Update","Weekly");
$weekly_update_time = strtotime($update_time_weekly);
$time_difference_weekly = time() - $weekly_update_time;
if ($time_difference_weekly >= 604800){
	$date = date('Y-m-d 00:00:00', time());
	queryUPD("updates","Time",$date,"Update","Weekly");
	$query = "UPDATE `compare` SET `pageViews_week`='0'";
	$query_run = mysql_query($query);
}?>
<?php // TOP COMPARISONS CODE
$comparison_category_ar = array();
$pageURL_ar = array();
$choice1 = array();
$choice2 = array();
$choice1_name = array();
$choice2_name = array();
$pageViews_day_ar = array();
$extension = array();
$pic = array();
$TAI = array();

$x = 0;
$place = 0;

$query = "SELECT `id`,`time_added`,`category`,`pageURL`,`choice_1`,`choice_2`,`pageViews_day` FROM `compare` WHERE 1 ORDER BY `pageViews_day` DESC LIMIT 30";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$choice1[$x] =  $query_row["choice_1"];
	$choice2[$x] =  $query_row["choice_2"];
	$choice1_name[$x] = queryULT("Name",$query_row["category"], "id",$choice1[$x]);
	$choice2_name[$x] = queryULT("Name",$query_row["category"], "id",$choice2[$x]);
	$comparison_category_ar[$x] = $query_row["category"];
	$pageViews_day_ar[$x] = $query_row["pageViews_day"];
	$pageURL_ar[$x] = $query_row["pageURL"];
	if($comparison_category_ar[$x]=="games"){
		$extension[$x]="/Icons/";
		$pic[$x]="icon_img";
	} else {
		$extension[$x]="/";
		$pic[$x] = "pic_name";
	}
	$TAI1[$x] = ucfirst($comparison_category_ar[$x]).$extension[$x].queryULT($pic[$x],$comparison_category_ar[$x],"id",$choice1[$x]);
	$TAI2[$x] = ucfirst($comparison_category_ar[$x]).$extension[$x].queryULT($pic[$x],$comparison_category_ar[$x],"id",$choice2[$x]);
	$x++;	
}

?>
<?php // TOP GAMES CODE
$x = 0;
$x2 = 0;
$x2_w = 0;
$fpURLG = array();	// First page Url - games
$fpC1G = array();	// First page choice 1 - games
$fpC2G = array();	// First page choice 2 - games
$fpCN1G = array();	// First page choice 1's name - games
$fpCN2G = array();	// First page choice 2's name - games
$comparison_category = 'games';
$extensionG = "/Icons/";
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `pageViews_day` DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while ($query_row = mysql_fetch_assoc($query_run)){	
	if (($x+1) <= 20){
		$pageViews_day = $query_row["pageViews_day"];
		if ($pageViews_day != 0){
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLG)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1G[$x] =  $query_row["choice_1"];
			$fpC2G[$x] =  $query_row["choice_2"];
			$fpCN1G[$x] = queryULT("Name", $comparison_category, "id",$fpC1G[$x]);
			$fpCN2G[$x] = queryULT("Name", $comparison_category, "id",$fpC2G[$x]);
		} else {
			$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `id` DESC ";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			while ($x2_w<=$x2){
				$query_row = mysql_fetch_assoc($query_run);
				$x2_w++;
			}
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLG)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1G[$x] =  $query_row["choice_1"];
			$fpC2G[$x] =  $query_row["choice_2"];
			$fpCN1G[$x] = queryULT("Name", $comparison_category, "id",$fpC1G[$x]);
			$fpCN2G[$x] = queryULT("Name", $comparison_category, "id",$fpC2G[$x]);
			$x2_w = 0;
			$x2++;
		}	
		$fpURLG[$x] = $pageURL;
		
		$fpPIC1G[$x] = ucfirst($comparison_category).$extensionG.queryULT("icon_img",$comparison_category,"id",$fpC1G[$x]);
		$fpPIC2G[$x] = ucfirst($comparison_category).$extensionG.queryULT("icon_img",$comparison_category,"id",$fpC2G[$x]);
		$fpFullPIC1G[$x] = ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$fpC1G[$x]);
		$fpFullPIC2G[$x] = ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$fpC2G[$x]);
		$x++;
	}
}
?>
<?php // TOP LAPTOPS CODE
$x = 0;
$x2 = 0;
$x2_w = 0;
$fpURLL = array();	// First page Url - laptops
$fpC1L = array();	// First page choice 1 - laptops
$fpC2L = array();	// First page choice 2 - laptops
$fpCN1L = array();	// First page choice 1's name - laptops
$fpCN2L = array();	// First page choice 2's name - laptops
$comparison_category = 'laptops';
$extensionL = "/";
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `pageViews_day` DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while ($query_row = mysql_fetch_assoc($query_run)){	
	if (($x+1) <= 20){
		$pageViews_day = $query_row["pageViews_day"];
		if ($pageViews_day != 0){
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLL)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1L[$x] =  $query_row["choice_1"];
			$fpC2L[$x] =  $query_row["choice_2"];
			$fpCN1L[$x] = queryULT("Name", $comparison_category, "id",$fpC1L[$x]);
			$fpCN2L[$x] = queryULT("Name", $comparison_category, "id",$fpC2L[$x]);
		} else {
			$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `id` DESC ";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			while ($x2_w<=$x2){
				$query_row = mysql_fetch_assoc($query_run);
				$x2_w++;
			}
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLL)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1L[$x] =  $query_row["choice_1"];
			$fpC2L[$x] =  $query_row["choice_2"];
			$fpCN1L[$x] = queryULT("Name", $comparison_category, "id",$fpC1L[$x]);
			$fpCN2L[$x] = queryULT("Name", $comparison_category, "id",$fpC2L[$x]);
			$x2_w = 0;
			$x2++;
		}	
		$fpURLL[$x] = $pageURL;
		
		$fpPIC1L[$x] = ucfirst($comparison_category).$extensionL.queryULT("pic_name",$comparison_category,"id",$fpC1L[$x]);
		$fpPIC2L[$x] = ucfirst($comparison_category).$extensionL.queryULT("pic_name",$comparison_category,"id",$fpC2L[$x]);
		$x++;
	}
}
?>
<?php // TOP PHONES CODE
$x = 0;
$x2 = 0;
$x2_w = 0;
$fpURLP = array();	// First page Url - laptops
$fpC1P = array();	// First page choice 1 - laptops
$fpC2P = array();	// First page choice 2 - laptops
$fpCN1P = array();	// First page choice 1's name - laptops
$fpCN2P = array();	// First page choice 2's name - laptops
$comparison_category = 'phones';
$extensionP = "/";
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `pageViews_day` DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while ($query_row = mysql_fetch_assoc($query_run)){	
	if (($x+1) <= 20){
		$pageViews_day = $query_row["pageViews_day"];
		if ($pageViews_day != 0){
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLP)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1P[$x] =  $query_row["choice_1"];
			$fpC2P[$x] =  $query_row["choice_2"];
			$fpCN1P[$x] = queryULT("Name", $comparison_category, "id",$fpC1P[$x]);
			$fpCN2P[$x] = queryULT("Name", $comparison_category, "id",$fpC2P[$x]);
		} else {
			$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `id` DESC ";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			while ($x2_w<=$x2){
				$query_row = mysql_fetch_assoc($query_run);
				$x2_w++;
			}
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $fpURLP)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$fpC1P[$x] =  $query_row["choice_1"];
			$fpC2P[$x] =  $query_row["choice_2"];
			$fpCN1P[$x] = queryULT("Name", $comparison_category, "id",$fpC1P[$x]);
			$fpCN2P[$x] = queryULT("Name", $comparison_category, "id",$fpC2P[$x]);
			$x2_w = 0;
			$x2++;
		}	
		$fpURLP[$x] = $pageURL;
		
		$fpPIC1P[$x] = ucfirst($comparison_category).$extensionP.queryULT("pic_name",$comparison_category,"id",$fpC1P[$x]);
		$fpPIC2P[$x] = ucfirst($comparison_category).$extensionP.queryULT("pic_name",$comparison_category,"id",$fpC2P[$x]);
		$x++;
	}
}
?>

<?php // LATEST COMPARISON
$query = "SELECT `id`,`time_added`,`category`,`pageURL`,`choice_1`, `choice_2` FROM `compare` WHERE  1 ORDER BY `time_added` DESC LIMIT 300" ;
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$pages_latest = ceil($query_num_rows/$num_comparisons_pp);
$comparison_category_latest = array();
$choice1_latest = array();
$choice2_latest = array();
$choice1_name_latest = array();
$choice2_name_latest = array();
$pageURL_latest = array();
$extension_latest = array();
$pic_latest = array();
$Display_all = true;
$place = 0;
$x = 0;

$query = "SELECT `id`,`time_added`,`category`,`pageURL`,`choice_1`, `choice_2` FROM `compare` WHERE  1 ORDER BY `time_added` DESC LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$choice1_latest[$x] =  $query_row["choice_1"];
	$choice2_latest[$x] =  $query_row["choice_2"];
	$choice1_name_latest[$x] = queryULT("Name",$query_row["category"], "id",$choice1_latest[$x]);
	$choice2_name_latest[$x] = queryULT("Name",$query_row["category"], "id",$choice2_latest[$x]);
	$comparison_category_latest[$x] = $query_row["category"];
	$pageURL_latest[$x] = $query_row["pageURL"];
	if($comparison_category_latest[$x]=="games"){
		$extension_latest[$x]="/Icons/";
		$pic_latest[$x]="icon_img";
	} else {
		$extension_latest[$x]="/";
		$pic_latest[$x] = "pic_name";
	}
	$x++;	
}
?>

<?php // MOST VIEWED ITEMS ALL
$comparison_category_TopItem = array();
$id_TopItem = array();
$name_TopItem  = array();
$extension_TopItem = array();
$pic_TopItem = array();
$x = 0;

$query = "SELECT * FROM ( 
	SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`icon_img` AS `pic_name` FROM `games` WHERE `verified`='1' UNION
	SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`pic_name` FROM `laptops` WHERE `verified`='1' UNION
	SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`pic_name` FROM `phones` WHERE `verified`='1' ) AS search ORDER BY `pageViews_day` DESC LIMIT 10";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$id_TopItem[$x] = $query_row["id"];
	$name_TopItem[$x] = $query_row["Name"];
	$comparison_category_TopItem[$x] = $query_row["category"];
	$pic_TopItem[$x] = $query_row["pic_name"];
	if($comparison_category_TopItem[$x]=="games"){
		$extension_TopItem[$x]="/Icons/";
	} else {
		$extension_TopItem[$x]="/";
	}
	$x++;	
}
?>
<?php // MOST VIEWED ITEMS PHONES
$id_TopItemP = array();
$name_TopItemP  = array();
$pic_TopItemP = array();
$x = 0;

$query = "SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`pic_name` FROM `phones` WHERE 1 ORDER BY `pageViews_day` DESC LIMIT 10";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$id_TopItemP[$x] = $query_row["id"];
	$name_TopItemP[$x] = $query_row["Name"];
	$pic_TopItemP[$x] = $query_row["pic_name"];
	$x++;	
}
?>
<?php // MOST VIEWED ITEMS LAPTOPS
$id_TopItemL = array();
$name_TopItemL  = array();
$pic_TopItemL = array();
$x = 0;

$query = "SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`pic_name` FROM `laptops` WHERE 1 ORDER BY `pageViews_day` DESC LIMIT 10";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$id_TopItemL[$x] = $query_row["id"];
	$name_TopItemL[$x] = $query_row["Name"];
	$pic_TopItemL[$x] = $query_row["pic_name"];
	$x++;	
}
?>
<?php // MOST VIEWED ITEMS GAMES
$id_TopItemG = array();
$name_TopItemG  = array();
$pic_TopItemG = array();
$x = 0;

$query = "SELECT `id`,`time_added`,`category`,`Name`,`pageViews_day`,`icon_img` FROM `games` WHERE 1 ORDER BY `pageViews_day` DESC LIMIT 10";
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$id_TopItemG[$x] = $query_row["id"];
	$name_TopItemG[$x] = $query_row["Name"];
	$pic_TopItemG[$x] = $query_row["icon_img"];
	$x++;	
}

/*
$image = 'Pictures/Games/bioshock_infinite.jpg';
$im = new Imagick();
$im->pingImage($image);
$im->readImage( $image );
$im->thumbnailImage( 100, null );
$im->writeImage( '/tmp/spork_thumbnail.jpg' );
$im->destroy();

<img src="Pictures/Games/bioshock_infinite.jpg">
*/
?>
<div class="results_heading_2 topTitle">Top Comparisons Today
</div><!-- TOP COMPARISONS DISPLAY BOX -->

<table class="compTable">
	<tr>
		<td colspan="1">
			<table class="fpSideTable">
				<tr class="fpSideTr">
					<td class="fpSideContainer" id="fpAll">
						<div class="fpSide">
							<div class="fpSideText">
								All
							</div>
						</div>
					</td>
				</tr>
				<tr class="fpSideTr">
					<td class="fpSideContainer" id="fpPhones">
						<div class="fpSide">
							<div class="fpSideText">
								Phones
							</div>
						</div>
					</td>
				</tr>
				<tr class="fpSideTr">
					<td class="fpSideContainer" id="fpLaptops">
						<div class="fpSide">
							<div class="fpSideText">
								Laptops
							</div>
						</div>
					</td>
				</tr>
				<tr class="fpSideTr">
					<td class="fpSideContainer" id="fpGames">
						<div class="fpSide">
							<div class="fpSideText">
								Games
							</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
		
		<td colspan="3" rowspan="1" class="border" id="showing_comparison"><!-- GAME TOP -->
		<div class="compTopPaddingBox">
		<div class="compTopContainter">
		<table class="slidingTopAll">
		<tr>
		<!-- TOP 3 -->
		<?php
		for ($x = 0; ($x+1)<=12;$x++){
		?>
			<td>
			
			<div class="fpTopAll fpTop"><!-- TOP ALL -->
			<a href="<?php echo "compare.php?".$comparison_category_ar[$x]."-c".$pageURL_ar[$x]."-gc";?>" id="<?php echo"allTop".($x+1);?>" class="front_top_comp">
				<table class="compTableTable">
					<tr>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo ucfirst($comparison_category_ar[$x])."/".queryULT("pic_name",$comparison_category_ar[$x],"id",$choice1[$x]);?>">
						</td>
						<td colspan="2" >
							<div class="bigCompLine"></div>
						</td>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo ucfirst($comparison_category_ar[$x])."/".queryULT("pic_name",$comparison_category_ar[$x],"id",$choice2[$x]);?>">	
						</td>
					</tr>
					<tr>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice1_name[$x]."Top";?></td>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice2_name[$x];?></td> 
					</tr>
				</table>
			</a>
			</div>
			
			<div class="fpTopPhones fpTop"><!-- TOP PHONES -->
			<a href="<?php echo "compare.php?games-c".$fpURLP[$x]."-gc";?>" class="front_top_comp">
				<table class="compTableTable">
					<tr>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpPIC1P[$x];?>">
						</td>
						<td colspan="2" >
							<div class="bigCompLine"></div>
						</td>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpPIC2P[$x];?>">	
						</td>
					</tr>
					<tr>
						<td colspan="3" class="comptTableTopImgName"><?php echo $fpCN1P[$x];?></td>
						<td colspan="3" class="comptTableTopImgName"><?php echo $fpCN2P[$x];?></td> 
					</tr>
				</table>
			</a>
			</div>
			
			<div class="fpTopLaptops fpTop"><!-- TOP LAPTOPS -->
			<a href="<?php echo "compare.php?".$comparison_category_ar[$x]."-c".$pageURL_ar[$x]."-gc";?>" id="<?php echo"allTop".($x+1);?>" class="front_top_comp">
				<table class="compTableTable">
					<tr>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpPIC1L[$x];?>">
						</td>
						<td colspan="2" >
							<div class="bigCompLine"></div>
						</td>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpPIC2L[$x];?>">	
						</td>
					</tr>
					<tr>
						<td colspan="3" class="comptTableTopImgName"><?php echo $fpCN1L[$x];?></td>
						<td colspan="3" class="comptTableTopImgName"><?php echo $fpCN2L[$x];?></td> 
					</tr>
				</table>
			</a>
			</div>
			
			<div class="fpTopGames fpTop"><!-- TOP GAMES -->
			<a href="<?php echo "compare.php?games-c".$fpURLG[$x]."-gc";?>" id="<?php echo"allTop".($x+1);?>" class="front_top_comp">
				<table class="compTableTable">
					<tr>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpFullPIC1G[$x];?>">
						</td>
						<td colspan="2" >
							<div class="bigCompLine"></div>
						</td>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo $fpFullPIC2G[$x];?>">
						</td>
					</tr>
					<tr>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice1_name[$x];?></td>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice2_name[$x];?></td> 
					</tr>
				</table>
			</a>
			</div>
			
			</td>
		<?php } ?>
		</tr>
		</table>
		</div>
		</div>
		</td>
		
		<td colspan="1" rowspan="3"><!-- SIDE MOST VIEWED -->
			<table>
				<tr>
					<td style="position:relative;">
						<div class="fpMostViewedItems" style="max-height:480px; border-bottom:1px solid #CCCCCC;">
							Popular Items
						</div>
					</td>
				</tr>
				
				<tr>
					<td>
						<div class="fpTableSdWrapper" id="fpTableSdWrapperAll">
							<div class="TopItems TopItemsAll">
								<ul>
									<?php for($x=0; $x<12; $x++){ ?>
									<li>
										<div class="fpItemImgContainer" >
											<div class="fpItemImg" >
												<a href="<?php echo "details_info.php?=".$comparison_category_TopItem[$x]."-".$id_TopItem[$x]."-c";?>">
													<img src="Pictures/<?php echo ucfirst($comparison_category_TopItem[$x]).$extension_TopItem[$x].$pic_TopItem[$x];?>" class="itemPic"/>
												</a>
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
						</div>
						<div class="fpTableSdWrapper" id="fpTableSdWrapperGames">
							<div class="TopItems TopItemsGames">
								<ul>
									<?php for($x=0; $x<12; $x++){ ?>
									<li>
										<div class="fpItemImgContainer" >
											<div class="fpItemImg" >
												<a href="<?php echo "details_info.php?=games-".$id_TopItemG[$x]."-c";?>">
													<img src="Pictures/<?php echo "Games/Icons/".$pic_TopItemG[$x];?>" class="itemPic"/>
												</a>
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
						</div>	
						<div class="fpTableSdWrapper" id="fpTableSdWrapperPhones">
							<div class="TopItems TopItemsPhones">
								<ul>
									<?php for($x=0; $x<12; $x++){ ?>
									<li>
										<div class="fpItemImgContainer" >
											<div class="fpItemImg" >
												<a href="<?php echo "details_info.php?=phones-".$id_TopItemP[$x]."-c";?>">
													<img src="Pictures/<?php echo "Phones/".$pic_TopItemP[$x];?>" class="itemPic"/>
												</a>
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
						</div>
						<div class="fpTableSdWrapper" id="fpTableSdWrapperLaptops">
							<div class="TopItems TopItemsLaptops">
								<ul>
									<?php for($x=0; $x<12; $x++){ ?>
									<li>
										<div class="fpItemImgContainer" >
											<div class="fpItemImg" >
												<a href="<?php echo "details_info.php?=laptops-".$id_TopItemL[$x]."-c";?>">
													<img src="Pictures/<?php echo "Laptops/".$pic_TopItemL[$x];?>" class="itemPic"/>
												</a>
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr><!-- BOTTOM COMPARISONS -->
		<td colspan="4" rowspan="1" id="sliding" class="border">
			<div class="fpSlidingDiv" id="fpSlidingAll">
			<table class="fpSlidingTables" colspan="4">
				<tr>
					<?php for($x=0; $x<12; $x++){?>
					<td colspan="1" class="comp_cols border <?php if($x==0){ echo"compsHover";}?> " ><!-- ALL -->
					<div class="fpcompPaddingBox <?php if(($x+1)%4==0){echo"fpcompPaddingBoxLast";}?>">
					<a href="<?php echo "compare.php?".$comparison_category_ar[$x]."-c".$pageURL_ar[$x]."-gc";?>" class="comps_dp <?php echo"top_dp_".$top_game_id;?>">
						<table class="comp_front_table_comps">
							<tr>
							<td colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $TAI1[$x];?>">
							</td>
							<td colspan="2" >
								<div class="smallCompLine"></div>
							</td>
							<td  colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $TAI2[$x];?>">
							</td>
							</tr>
						</table>
					</a>
					</div>
					</td>
					<?php } ?>
				</tr>
			</table>
			</div>
			
			<div class="fpSlidingDiv" id="fpSlidingGames">
			<table class="fpSlidingTables" colspan="4">
				<tr>
					<?php for($x=0; $x<12; $x++){?>
					<td colspan="1" class="comp_cols border <?php if($x==0){ echo"compsHover";}?> " ><!-- GAME -->
					<div class="fpcompPaddingBox <?php if(($x+1)%4==0){echo"fpcompPaddingBoxLast";}?>">
					<a href="<?php echo "compare.php?games-c".$fpURLG[$x]."-gc";?>"  class="comps_dp <?php echo"top_dp_".$top_game_id;?>">
						<table class="comp_front_table_comps">
							<tr>
							<td colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC1G[$x];?>">
							</td>
							<td colspan="2" >
								<div class="smallCompLine"></div>
							</td>
							<td  colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC2G[$x];?>">
							</td>
							</tr>
						</table>
					</a>
					</div>
					</td>
					<?php } ?>
				</tr>
			</table>
			</div>
			
			<div class="fpSlidingDiv" id="fpSlidingLaptops">
			<table class="fpSlidingTables"colspan="4">
				<tr>
					<?php for($x=0; $x<12; $x++){?>
					<td colspan="1" class="comp_cols border <?php if($x==0){ echo"compsHover";}?>" ><!-- LAPTOPS -->
					<div class="fpcompPaddingBox <?php if(($x+1)%4==0){echo"fpcompPaddingBoxLast";}?>">
					<a href="<?php echo "compare.php?laptops-c".$fpURLL[$x]."-gc";?>" class="comps_dp <?php echo"top_dp_".$top_game_id;?>">
						<table class="comp_front_table_comps">
							<tr>
							<td colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC1L[$x];?>">
							</td>
							<td colspan="2" >
								<div class="smallCompLine"></div>
							</td>
							<td  colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC2L[$x];?>">
							</td>
							</tr>
						</table>
					</a>
					</div>
					</td>
					<?php } ?>
				</tr>
			</table>
			</div>
			
			<div class="fpSlidingDiv" id="fpSlidingPhones">
			<table class="fpSlidingTables" colspan="4">
				<tr>
					<?php for($x=0; $x<12; $x++){?>
					<td colspan="1" class="comp_cols border <?php if($x==0){ echo"compsHover";}?>" ><!-- PHONES -->
					<div class="fpcompPaddingBox <?php if(($x+1)%4==0){echo"fpcompPaddingBoxLast";}?>">
					<a href="<?php echo "compare.php?phones-c".$fpURLP[$x]."-gc";?>" class="comps_dp <?php echo"top_dp_".$top_game_id;?>">
						<table class="comp_front_table_comps">
							<tr>
							<td colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC1P[$x];?>">
							</td>
							<td colspan="2" >
								<div class="smallCompLine"></div>
							</td>
							<td  colspan="2">
								<img class="fpImg" src="Pictures/<?php echo $fpPIC2P[$x];?>">
							</td>
							</tr>
						</table>
					</a>
					</div>
					</td>
					<?php } ?>
				</tr>
			</table>
			</div>
			</td>
	</tr>
	<tr><!-- BACK AND FRONT SLIDING -->
		<td colspan="1"> 
			<div id="back_sliding1" class="Next-Back">Previous</div>
		</td>
		<td class="compNoTdMiddle" colspan="2">
			<div class="compNoContainer">
			<div class="compNo" id="current_comp_id">1</div>
			<div class="compNo">/ 12</div>
			</div>
		</td>
		<td class="compNoTdRight">
			<div id="next_sliding1" class="Next-Back">Next</div>
		</td>
	</tr>
</table>
	
<div id="indexBottom">
<div class="pageNumberPos" style="top:<?php if($Display_all==true){echo 86+((ceil((count($choice1_name_latest))/3))*130); } else { echo 86+((ceil((count($choice1_name_search))/3))*130); }?>px;"><!-- PAGE NUMBERS -->
	<table class="pageNumberTable">
		<tr>
			<td class="pageText">
				Page
			</td>
			<td>
			<div id="table_scroll_horizontal" > 
				<table class="pageNumbersTable2">
					<tr>
					<?php 
					if($Display_all == true && $pages_search == 0){
						for($x=0; $x<$pages_latest; $x++){?>
						<td class="page_numbers" <?php if(($x+1)==$page_number){ echo "id='selected_page_number'"; }?> >
								
							<div class="pageNumbersPadding">
								<a href="<?php pageNumbers($x+1);?>"><?php echo $x+1;?></a>
							</div>
						
						</td>
						
						<?php } ?>
					<?php } else {
						for($x=0; $x<$pages_search; $x++){?>
						<td class="page_numbers" <?php if(($x+1)==$page_number){ echo "id='selected_page_number'"; }?> >
								
							<div class="pageNumbersPadding">		
								<a href="<?php pageNumbers($x+1);?>"><?php echo $x+1;?></a>
							</div>
							
						</td>
						<?php } ?>
					<?php } ?>
					</tr>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<div class="displayLatestResults"><!-- RESULTS -->
<?php if ($Search==false){?><!-- DISPLAYING SEARCH RESULTS -->
<div class="results_heading_2">Newest Laptop Comparisons</div>
<table class="displayLatestResultsTable">
<?php
for ($x=0;$x<count($pageURL_latest);$x++){
	if (($x%3)==0){echo "<tr>";};?>
		<td class="comp_select">
		<div class="compBox">
		<a class="displayLatestResultsHref" href="<?php echo "compare.php?".$comparison_category_latest[$x]."-c".$pageURL_latest[$x]."-gc";?>">
			<table class="displayLatestResultsTable2">
				<tr>
				<td colspan="2" >
					<img src="Pictures/<?php echo ucfirst($comparison_category_latest[$x]).$extension_latest[$x].queryULT($pic_latest[$x],$comparison_category_latest[$x],"id",$choice1_latest[$x]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo ucfirst($comparison_category_latest[$x]).$extension_latest[$x].queryULT($pic_latest[$x],$comparison_category_latest[$x],"id",$choice2_latest[$x]);?>" class="compResultImgs">
				</td>
				</tr>
				<tr class="name_details nameDetailsAdj">
					<td colspan="6" style="border-collapse:collapse;">
						<table style="border-collapse:collapse; border:1px solid RoyalBlue; background-color:white; left:0px;" class="compDetailsTable">
							<tr>
								<td class="name_details_td"><?php echo $choice1_name_latest[$x];?></td>
								<td class="name_details_td"><?php echo $choice2_name_latest[$x];?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</a>	
		</div>
		</td>
	<?php if ((($x-2)%3)==0){echo "</tr>";}}?>
</table>
<?php } else if ($Search==true){?>
<div class="results_heading_2">Search Results</div>
<table class="displayLatestResultsTable">
<?php
for ($x=0;$x<count($choice1_name_search);$x++){
	if (($x%3)==0){echo "<tr>";};?>
		<td class="comp_select">
		<div class="compBox">
		<a class="displayLatestResultsHref" href="compare.php?<?php echo $category[$x]."-c".$pageURL_search[$x]."-gc";?>">
			<table class="displayLatestResultsTable2">
				<tr>
				<td colspan="2">
					<img src="Pictures/<?php echo ucfirst($category[$x]).$ext[$x].queryULT($select[$x],$category[$x],"id",$choice1_search[$x]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo ucfirst($category[$x]).$ext[$x].queryULT($select[$x],$category[$x],"id",$choice2_search[$x]);?>" class="compResultImgs">
				</td>
				</tr>
				<tr class="name_details nameDetailsAdj">
					<td colspan="6" style="border-collapse:collapse;">
						<table style="border-collapse:collapse; border:1px solid RoyalBlue; background-color:white; left:0px;" class="compDetailsTable">
							<tr>
								<td class="name_details_td"><?php echo $choice1_name_search[$x];?></td>
								<td class="name_details_td"><?php echo $choice2_name_search[$x];?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</a>	
		</div>
		</td>
	<?php if ((($x-2)%3)==0){echo "</tr>";}}?>
</table>
<?php } ?>
</div>

<div class="searchBarDiv"><!-- SEARCH BAR -->
<table class="searchBarTable">
	<tr>
		<td class="searchBar1Td">
			<div class="search_nav_heads" id="games_search">
				Games
			</div>
		</td>
	</tr>
	<tr>  
		<td style="background-color:white; ">
			<div  id="search_options_games" class="searchBar1Options">
				<table>
				<form method="GET" action="<?php echo curPageUrl();?>">
					<input type="hidden" readonly="true" value="comparison"  name="search_choice"/>
					<?php require("Incs/Incs/games_search_compareTable.inc.php");?>
				</form>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative;top:-6px;">
			<div class="search_nav_heads" id="laptops_search" style="border-top:0;">
			Laptops
			</div>
		</td>
	</tr>
	<tr>  
		<td style="background-color:white; ">
			<div id="search_options_laptops" class="searchBar2Options">
				<table>
					<form method="GET" action="<?php echo curPageUrl();?>">
						<input type="hidden" readonly="true" value="comparison"  name="search_choice"/>
						<?php require("Incs/Incs/laptops_search_compareTable.inc.php");?>
					</form>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative; top:-10px;">
			<div class="search_nav_heads" id="phones_search" style="border-top:0;">
				Phones
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="search_options_phones" class="searchBar3Options">
				<table>
					<form method="GET" action="<?php echo curPageUrl();?>">						
						<input type="hidden" readonly="true" value="comparison"  name="search_choice"/>
						<?php require("Incs/Incs/phones_search_compareTable.inc.php");?>
					</form>
				</table>
			</div>
		</td>
	</tr>
</table>
<div style="position:relative; background-color:#E9E9E9; top:0px;padding:14px; text-align:center; border:1px solid #CCCCCC;"><!-- ADVERTISEMENT -->
		<div>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- FrontAd -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:200px;height:200px"
				 data-ad-client="ca-pub-8679411009445717"
				 data-ad-slot="7777214381"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
</div>

</div>

</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

<script type="text/javascript" src="Incs/iscroll.js"></script>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jquery-ui.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/indexFront.js"></script>
</body>
</html>