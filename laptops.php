<!DOCTYPE HTML>
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
<title>
WhichToPick: Laptops
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
<?php // SEARCH COMPARISONS CODE
$num_comparisons_pp = 51;
@$pageURL = curPageUrl();
$comparison_category = "laptops";
$Display_all = true;
$Display_latest = true;
$Search = false;
if(strpos($pageURL, "page=")){
	$page_number = substr($pageURL, (strpos($pageURL, "page="))+5);
} else {
	$page_number = 1;
}
require('Incs/Incs/laptops_search_compare.inc.php');
?>
<?php // TOP COMPARISONS CODE
$x = 0;
$x2 = 0;
$x2_w = 0;
$pageURLArray = array();
$choice1 = array();
$choice2 = array();
$choice1_name = array();
$choice2_name = array();
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `pageViews_day` DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while ($query_row = mysql_fetch_assoc($query_run)){	
	if (($x+1) <= 20){
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
		} else {
			$query = "SELECT * FROM `compare` WHERE `category`='".$comparison_category."' ORDER BY `id` DESC ";
			$query_run = mysql_query($query);
			$query_num_rows = mysql_num_rows($query_run);
			while ($x2_w<=$x2){
				$query_row = mysql_fetch_assoc($query_run);
				$x2_w++;
			}
			$pageURL = $query_row["pageURL"];
			while(in_array($pageURL, $pageURLArray)){
				$query_row = mysql_fetch_assoc($query_run);
				$pageURL = $query_row["pageURL"];
			}
			$choice1[$x] =  $query_row["choice_1"];
			$choice2[$x] =  $query_row["choice_2"];
			$choice1_name[$x] = queryULT("Name", $comparison_category, "id",$choice1[$x]);
			$choice2_name[$x] = queryULT("Name", $comparison_category, "id",$choice2[$x]);
			$x2_w = 0;
			$x2++;
		}	
		$pageURLArray[$x] = $pageURL;
		$x++;
	}
}
?>
<?php // LATEST COMPARISONS CODE
$query = "SELECT * FROM `compare` WHERE `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$pages_latest = ceil($query_num_rows/$num_comparisons_pp);
@$pageURL = curPageUrl();
$x = 0;
$choice1_latest = array();
$choice2_latest = array();
$choice1_name_latest = array();
$choice2_name_latest = array();
$choice1_brand_latest = array();
$choice2_brand_latest = array();
$pageUrl_latest = array();
$query = "SELECT * FROM  `compare` WHERE `category`='".$comparison_category."' ORDER BY `time_added` DESC LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
$query_run = mysql_query($query);
while($query_row = mysql_fetch_assoc($query_run)){
	$choice1_latest[$x] =  $query_row["choice_1"];
	$choice2_latest[$x] =  $query_row["choice_2"];
	$choice1_name_latest[$x] = queryULT("Name", $comparison_category, "id",$choice1_latest[$x]);
	$choice2_name_latest[$x] = queryULT("Name", $comparison_category, "id",$choice2_latest[$x]);
	$choice1_brand_latest[$x] =  queryULT("Brand",$comparison_category,"id",$choice1_latest[$x]);
	$choice2_brand_latest[$x] =  queryULT("Brand",$comparison_category,"id",$choice2_latest[$x]);
	$pageUrl_latest[$x] = $query_row["pageURL"];
	$x++;
}
?>

<div class="results_heading_2 topTitle">Top Laptop Comparisons Today</div><!-- TOP COMPARISONS DISPLAY BOX -->
<table class="compTable">
	<tr>
		<td colspan="3" rowspan="1" class="border" id="showing_comparison"><!-- GAME TOP -->
		<div class="compTopPaddingBox">
		<!-- TOP 3 -->
		<?php
		$top_game_id = 1;
		for ($x = 0; ($x+1)<=9;$x++){
		?>
			<a href="<?php echo "compare.php?".$comparison_category."-c".$pageURLArray[$x]."-gc";?>" id="<?php echo"game_top_".$top_game_id;?>" class="front_top_comp">
				<table class="compTableTable">
					<tr>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1[$x]);?>"/>
						</td>
						<td colspan="2" >
							<div style="height:332px; background-color:green; width:1px; margin-top:-2px;"></div>
						</td>
						<td colspan="2" class="compTableTableTd">
							<img class="compTableTopImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2[$x]);?>" />
						</td>
					</tr>
					<tr>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice1_name[$x];?></td>
						<td colspan="3" class="comptTableTopImgName"><?php echo $choice2_name[$x];?></td> 
					</tr>
				</table>
			</a>
		<?php	
			$top_game_id++;
		}?>
		</div>
		</td>	
		
		<td colspan="1" rowspan="3" style="border:1px solid #CCCCCC;" ><!-- DISPLAYING RIGHT HAND SIDE BOX WITH TOP COMPARISONS -->
			<div id="table-scroll" style="height:478px;" >
			<table id="top_results">
			<?php
			for ($x = 0; ($x+1)<=20;$x++){
			?>
				<tr>
					<td class="position"><?php echo $x+1;?></td>
					<td class="top_results_comparison">
						<a  href="compare.php?laptops-c<?php echo $pageURLArray[$x]."-gc";?>">
							<?php echo $choice1_name[$x]." <span style='color:orange;'>vs</span> ".$choice2_name[$x];?>
						</a>
					</td>
				</tr>
			<?php
			}
			?>
			</table>
			</div>
		</td>
	</tr>
	<tr><!-- GAME TOP DP -->
		<td colspan="1" rowspan="1" id="column_1" class="comp_cols border"><!-- GAME TOP DP COL 1 -->
		<div class="compPaddingBox">
		<?php
		$top_game_id = 1;
		$x = 0;
		for ($counter = 0; ($counter+1)<=3;$counter++){
		?>
		<a href="<?php echo "compare.php?".$comparison_category."-c".$pageURLArray[$x]."-gc";?>" id="<?php echo"game_top_dp_".$top_game_id;?>" class="comp_dp">
			<table class="comp_front_table_comps">
				<tr>
				<td colspan="2">
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1[$x]);?>"width="100">
				</td>
				<td colspan="2" >
					<div style="height:100px; background-color:green; width:1px;"></div>
				</td>
				<td  colspan="2">
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2[$x]);?>" width="100">
				</td>
				</tr>
			</table>
		</a>
		<?php
			$x+=3;
			$top_game_id+=3;
		}
		?>
		</div>
		</td>
		
		<td colspan="1" rowspan="1" id="column_2" class="comp_cols border"><!-- GAME TOP DP COL 2 -->
		<div class="compPaddingBox">
		<?php
		$top_game_id = 2;
		$x = 1;
		for ($counter = 0; ($counter+1)<=3;$counter++){
		?>
		<a href="<?php echo "compare.php?".$comparison_category."-c".$pageURLArray[$x]."-gc";?>" id="<?php echo"game_top_dp_".$top_game_id;?>" class="comp_dp">
			<table class="comp_front_table_comps" >
				<tr>
				<td colspan="2" >
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1[$x]);?>">
				</td>
				<td colspan="2" >
					<div style="height:100px; background-color:green; width:1px;"></div>
				</td>
				<td colspan="2" >
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2[$x]);?>">
				</td>
				</tr>
			</table>
		</a>
		<?php
			$x+=3;
			$top_game_id+=3;
		}
		?>
		</div>
		</td>
		
		<td colspan="1" rowspan="1" id="column_3" class="comp_cols border"><!-- GAME TOP DP COL 3 -->
		<div class="compPaddingBox">
		<?php
		$top_game_id = 3;
		$x = 2;
		for ($counter = 0; ($counter+1)<=3;$counter++){
		?>
		<a href="<?php echo "compare.php?".$comparison_category."-c".$pageURLArray[$x]."-gc";?>" id="<?php echo"game_top_dp_".$top_game_id;?>" class="comp_dp">
			<table class="comp_front_table_comps">
				<tr>
				<td colspan="2">
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1[$x]);?>">
				</td>
				<td colspan="2" >
					<div style="height:100px; background-color:green; width:1px;"></div>
				</td>
				<td colspan="2" >
					<img class="compImg" src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2[$x]);?>">
				</td>
				</tr>
			</table>
		</a>
		<?php
			$x+=3;
			$top_game_id+=3;
		}
		?>
		</div>
		</td>
	</tr>
	<tr>
		<div>
		<td colspan="1"> 
			<div id="back_sliding" class="Next-Back">Previous</div>
		</td>
		<td style="text-align:center;">
			<div style="display:inline;">
			<div style="color:#4d4d4d; display:inline;" id="current_comp_id">1</div>
			<div style="color:#4d4d4d; display:inline;">/ 9</div>
			</div>
		</td>
		<td style="text-align:right;">
			<div id="next_sliding" class="Next-Back">Next</div>
		</td>
		</div>
	</tr>
</table>

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
					if($Display_all == true){
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
<?php if ($Search==true){ ?><!-- DISPLAYING SEARCH RESULTS -->
<div class="results_heading_2">Search Results</div>
<table class="displayLatestResultsTable">
<?php
for ($x=0;$x<count($choice1_name_search);$x++){
	if (($x%3)==0){echo "<tr>";};?>
		<td class="comp_select">
		<div class="compBox">
		<a class="displayLatestResultsHref" href="compare.php?laptops-c<?php echo $pageURL_search[$x]."-gc";?>">
			<table class="displayLatestResultsTable2">
				<tr>
				<td colspan="2">
					<img src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1_search[$x]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2_search[$x]);?>" class="compResultImgs">
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
<?php } else if ($Search==false){?><!-- DISPLAY LATEST RESULTS -->
<div class="results_heading_2">Newest Laptop Comparisons</div>
<table class="displayLatestResultsTable">
<?php
for ($x=0;$x<count($pageUrl_latest);$x++){
	if (($x%3)==0){echo "<tr>";};?>
		<td class="comp_select">
		<div class="compBox">
		<a class="displayLatestResultsHref" href="compare.php?laptops-c<?php echo $pageUrl_latest[$x]."-gc";?>">
			<table class="displayLatestResultsTable2">
				<tr>
				<td colspan="2" >
					<img src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice1_latest[$x]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo ucfirst($comparison_category)."/".queryULT("pic_name",$comparison_category,"id",$choice2_latest[$x]);?>" class="compResultImgs">
				</td>
				</tr>
				<tr class="name_details nameDetailsAdj">
					<td colspan="6" style="border-collapse:collapse;">
						<table style="border-collapse:collapse; border:1px solid RoyalBlue; background-color:white; left:0px;" class="compDetailsTable">
							<tr>
								<td class="name_details_td"><?php echo $choice1_brand_latest[$x]."<br><span style='font-size:13px;'>".$choice1_name_latest[$x]."</span>";?></td>
								<td class="name_details_td"><?php echo $choice2_brand_latest[$x]."<br><span style='font-size:13px;'>".$choice2_name_latest[$x]."</span>";?></td>
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
<table style="background-color:white; width:230px; border-collapse:collapse;"><!-- SEARCH BAR -->
	
	<tr>
		<td>
			<div class="search_nav_heads" id="comparison_search">
				Search
			</div>
		</td>
	</tr>
	
	<tr>  
		<td style="background-color:white; ">
			<div id="search_options" style="border:1px solid #CCCCCC; position:relative;top:-2px; border-top:0;">
				<table>
					<form method="GET" action="<?php echo curPageUrl();?>">
						<?php require("Incs/Incs/laptops_search_compareTable.inc.php");?>
					</form>
				</table>
			</div>
		</td>
	</tr>
	<tr <?php if(!(loggedin())){ ?> class="login_link"<?php } ?>>
		<td style="position:relative;top:-4px;">
			<div class="search_nav_heads" style="border-top:0;">
				<a href="create.php?cat=<?php echo $comparison_category;?>-c" style="text-decoration:none; color:#4D4D4D;" <?php if(!(loggedin())){?> class="login_link_2"<?php } ?>>Create Comparison</a>
			</div>
		</td>
	</tr>
	<tr <?php if(!(loggedin())){?> class="login_link"<?php } ?>>
		<td style="position:relative;top:-6px;">
			<div class="search_nav_heads" style="border-top:0;">
				<a href="Add_item.php?=<?php echo $comparison_category;?>-c" style="text-decoration:none; color:#4D4D4D;" <?php if(!(loggedin())){?> class="login_link_2"<?php } ?>>Add Item</a>
			</div>
		</td>
	</tr>
</table>
	<div style="position:relative; background-color:#E9E9E9; top:6px;padding:14px; text-align:center; border:1px solid #CCCCCC;"> <!-- ADVERTISEMENT -->
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
<?php require('Incs/footer.inc.php');?>
</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/jq_front.js"></script>
</body>
</html>