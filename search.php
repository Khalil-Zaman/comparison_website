<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<title>
WhichToPick: Search
</title>
</head>
<body>
<div style="height:100%;">
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
<?php // SEARCH
if(strpos($pageURL, "page=")){
	$page_number = substr($pageURL, (strpos($pageURL, "page="))+5);
} else {
	$page_number = 1;
}
$noPages = 0;
$pages_search = 0;
$num_comparisons_pp = 50;
$search = '';
$search_rows = 0;
$Search = false;
if (isset($_GET['search'])&&!empty($_GET['search'])){
	$input = htmlentities(mysql_real_escape_string($_GET['search']));
	$search = str_replace(' ','%',$input);
	$games_ar = array('Name','Genre','Platforms','Released','Mode','category');
	$laptops_ar = array('Name','Brand','Processor','HDD','Resolution','Ram','Screen size','Graphics Card','category');
	$phones_ar = array('Name','Display','Front Camera','Internal Storage','Rear Camera','Brand','category');
	$games_search = '';
	$laptops_search = '';
	$phones_search = '';
	for($x=0; $x<count($games_ar); $x++){
		if(($x+1)==count($games_ar)){
			$games_search = $games_search."`".$games_ar[$x]."` LIKE '%".$search."%'";
		} else {
			$games_search = $games_search."`".$games_ar[$x]."` LIKE '%".$search."%' OR";
		}
	}
	for($x=0; $x<count($laptops_ar); $x++){
		if(($x+1)==count($laptops_ar)){
			$laptops_search = $laptops_search."`".$laptops_ar[$x]."` LIKE '%".$search."%'";
		} else {
			$laptops_search = $laptops_search."`".$laptops_ar[$x]."` LIKE '%".$search."%' OR";
		}
	}
	for($x=0; $x<count($phones_ar); $x++){
		if(($x+1)==count($phones_ar)){
			$phones_search = $phones_search."`".$phones_ar[$x]."` LIKE '%".$search."%'";
		} else {
			$phones_search = $phones_search."`".$phones_ar[$x]."` LIKE '%".$search."%' OR";
		}
	}
	$x=0;
	if($_GET['search_choice']=='category'){
		$query = 
		"SELECT * FROM ( 
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `games` WHERE ".$games_search." AND `verified`='1' UNION
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `laptops` WHERE ".$laptops_search." AND `verified`='1' UNION
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `phones` WHERE ".$phones_search."  AND `verified`='1' ) 
		AS search ORDER BY `time_added` DESC";
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		$noPages = ceil($search_rows/$num_comparisons_pp);
		$query = 
		"SELECT * FROM ( 
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `games` WHERE ".$games_search." AND `verified`='1' UNION
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `laptops` WHERE ".$laptops_search." AND `verified`='1' UNION
		SELECT `id`,`time_added`,`Name`,`category`,`pic_name` AS `img` FROM `phones` WHERE ".$phones_search."  AND `verified`='1' ) 
		AS search ORDER BY `time_added` DESC LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		while ($query_row = mysql_fetch_assoc($query_run)){
			$Category[$x] = $query_row['category'];
			$choice_pic_name[$x] = $query_row['img'];
			$choice_id[$x] = $query_row['id'];
			if($Category[$x]=='laptops'){
				$choice_brand = queryULT("Brand", 'laptops', "id",$choice_id[$x]);
				$choice_name[$x] = $choice_brand."<br><span style='font-size:13px;'>".$query_row['Name']."</span>";
			} else {
				$choice_name[$x] = $query_row['Name'];
			}
			$x++;
		}
	} else if ($_GET['search_choice']=='comparison'){
		$category = $ext = $select = $choice1_search = $choice2_search = $choice1_name_search = $chocie2_name_search = $pageURL_search = array();
		$x=0;
		$query = "SELECT `category`,`pageViews`,`time_added`,`pageURL` AS `URL`,`choice_1`,`choice_2` FROM `compare` WHERE 
		(`category`='games' AND ((`choice_1` IN (SELECT `id` FROM `games` WHERE ".$games_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `games` WHERE ".$games_search.")))) OR
		(`category`='phones' AND ((`choice_1` IN (SELECT `id` FROM `phones` WHERE ".$phones_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `phones` WHERE ".$phones_search.")))) OR
		(`category`='laptops' AND ((`choice_1` IN (SELECT `id` FROM `laptops` WHERE ".$laptops_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `laptops` WHERE ".$laptops_search."))))
		ORDER BY `pageViews` DESC";
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		$noPages = ceil($search_rows/$num_comparisons_pp);
		$query = "SELECT `category`,`pageViews`,`time_added`,`pageURL` AS `URL`,`choice_1`,`choice_2` FROM `compare` WHERE 
		(`category`='games' AND ((`choice_1` IN (SELECT `id` FROM `games` WHERE ".$games_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `games` WHERE ".$games_search.")))) OR
		(`category`='phones' AND ((`choice_1` IN (SELECT `id` FROM `phones` WHERE ".$phones_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `phones` WHERE ".$phones_search.")))) OR
		(`category`='laptops' AND ((`choice_1` IN (SELECT `id` FROM `laptops` WHERE ".$laptops_search.")) 	OR (`choice_2` IN (SELECT `id` FROM `laptops` WHERE ".$laptops_search."))))
		ORDER BY `pageViews` DESC LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		while ($query_row = mysql_fetch_assoc($query_run)){
			$category[$x] = $query_row['category'];
			if($query_row['category']=='games'){
				$ext[$x] = "/Icons/";
				$select[$x] = 'icon_img';
			} else {
				$ext[$x] = "/";
				$select[$x] = 'pic_name';
			}
			$choice1_search[$x] =  $query_row["choice_1"];
			$choice2_search[$x] =  $query_row["choice_2"];
			$choice1_name_search[$x] = queryULT("Name", $category[$x], "id",$choice1_search[$x]);
			$choice2_name_search[$x] = queryULT("Name", $category[$x], "id",$choice2_search[$x]);
			$pageURL_search[$x] = $query_row["URL"];
			$x++;
		}
	}
}
if($_GET['search_choice']=='category'){
	require('Incs/Incs/game_search.inc.php');
	require('Incs/Incs/laptops_search.inc.php');
	require('Incs/Incs/phones_search.inc.php');
} else if ($_GET['search_choice']=='comparison'){
	require('Incs/Incs/game_search_compare.inc.php');
	require('Incs/Incs/laptops_search_compare.inc.php');
	require('Incs/Incs/phones_search_compare.inc.php');
}
?>

<div class="results_heading_2"style="width:968px; top:10px; left:10px; position:relative;">Search Results</div><!-- TOP COMPARISONS DISPLAY BOX -->
<?php if($_GET['search_choice']=='category'){?>

<div style="position:relative; top:20px; left:10px; float:left;"><!-- CATEGORY SEARCH -->
<table style="background-color:white; width:230px; position:relative; top:0px;border-collapse:collapse; z-index:2;">
	<tr>
		<td>
			<div class="search_nav_heads" id="category_search_head">
				Category Search
				<a href="search.php?search_choice=comparison">
					<div class="links" id="switch_comparison"style="font-size:14px; text-align:center; color:#4D4D4D;font-style:italic;">Switch To Comparison Search</div>
				</a>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative;top:-2px;">
			<div class="search_nav category_search" id="games_search">
				Games
			</div>
		</td>
	</tr>
	<tr>
		<td style="background-color:white; ">
			<div  id="search_options_games" style="border:1px solid #CCCCCC; position:relative;top:-4px; border-top:0;">
				<table>
				<form method="GET" action="<?php echo curPageUrl();?>">
					<input type="hidden" readonly="true" value="category"  name="search_choice"/>
					<?php require("Incs/Incs/games_searchTable.inc.php");?>
				</form>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative;top:-6px;">
			<div class="search_nav category_search" id="laptops_search">
			Laptops
			</div>
		</td>
	</tr>
	<tr>  
		<td style="background-color:white; ">
			<div id="search_options_laptops" style="border:1px solid #CCCCCC; position:relative;top:-8px; border-top:0;">
			<table >
				<form method="GET" action="<?php echo curPageUrl();?>">
					<input type="hidden" readonly="true" value="category"  name="search_choice"/>
					<?php require("Incs/Incs/laptops_searchTable.inc.php");?>
				</form>
			</table>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative; top:-10px;">
			<div class="search_nav category_search" id="phones_search">
				Phones
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="search_options_phones" style="border:1px solid #CCCCCC; position:relative;top:-12px; border-top:0;">
			<table>
				<form method="GET" action="<?php echo curPageUrl();?>">			
					<input type="hidden" readonly="true" value="category"  name="search_choice"/>
					<?php require("Incs/Incs/phones_searchTable.inc.php");?>
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
</div>
<?php if ($search_rows!=0 && ($search!='' || $Search == true)){?>
<div style="position:relative; float:right; top:20px; right:10px; z-index:2; display:block;">
<table>
<?php
for ($x=0;$x<count($choice_name);$x++){
	if (($x%3)==0){echo "<tr>";};?>
		<td style="border:1px solid #CCCCCC">
		<div class="itemBox">
			<table  class="comparison_select">
				<tr style="text-align:center;">
					<td style="max-width:217px;" style="padding:12px;">
						<div style="padding-top:12px;"><?php echo $choice_name[$x]; ?></div>
					</td>
				</tr>
				<tr>
					<td id="pic" style="padding:13px; padding-top:3px;">
						<a href="details_info.php?=<?php echo $Category[$x]."-".$choice_id[$x]."-c"?>">
							<img src="Pictures/<?php echo ucfirst($Category[$x])."/".$choice_pic_name[$x]; ?>" width="217">
						</a>
					</td>
				</tr>
			</table>
		</div>
		</td>
	<?php if ((($x-2)%3)==0){echo "</tr>";}}?>
</table>
</div>
<?php } else {?>
<table style="position:relative; float:right; top:20px; right:10px; z-index:2;">
	<tr>
		<td id="id_search">
			<div>
				<form action="search.php" method="GET" id="search_form">
					<div style="border-radius:5px; width:640px; display:inline-block;border:1px solid #CCCCCC; background-color:white; height:30px;">
						<div style="display:inline-block; position:relative; left:5px; top:5px;width:17px;">
							<img src="Pictures/Website/search.png" height="14"/>
							<input type="hidden" readonly="true" value="<?php echo $search_choice_chosen;?>"  name="search_choice"/>
						</div>
						<div style="display:inline-block;position:relative; top:3px;">
							<input type="text" name="search" class="search_bar" id="search_bar_long"style="width:611px;height:21px;"placeholder="Search...">
						</div>
					</div>
				</form>
			</div>
		</td>
		<td>
			<div class="search_button" id="search_button">
				Search
			</div>
		</td>
	</tr>
	<?php if ($search!=''){?>
	<tr>
		<td colspan="2" style="color:#4D4D4D; padding:5px; font-size:18px; text-align:center;max-width:640px;">
			Sorry, your search
				<div style="color:#4D4D4D;font-style:italic; font-size:18px; white-space: nowrap; text-overflow: ellipsis; width:735px;white-space: nowrap;
				overflow: hidden;"> '<?php echo $_GET['search'];?>' </div>
		returned no results
		</td>
	</tr>
	<?php } else if ($search_rows==0 && $search=='' && $Search == true){?>
	<tr>
		<td colspan="2" style="color:#4D4D4D; padding:5px; font-size:18px; text-align:center;max-width:640px;">
			Sorry, no items matched your criteria.
		</td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

<?php } else {?>

<div style="position:relative; top:20px; left:10px; float:left;"><!-- COMPARISON SEARCH -->
<table style="background-color:white; width:230px; position:relative; border-collapse:collapse;z-index:2;">
	<tr>
		<td>
			<div class="search_nav_heads" id="category_search_head">
				Comparison Search
				<a href="search.php?search_choice=category">
					<div class="links" style="font-size:14px; text-align:center; color:#4D4D4D;font-style:italic;">Switch To Category Search</div>
				</a>
			</div>
		</td>
	</tr>
	<tr>
		<td style="position:relative;top:-2px;">
			<div class="search_nav category_search" id="games_search">
				Games
			</div>
		</td>
	</tr>
	<tr>  
		<td style="background-color:white; ">
			<div  id="search_options_games" style="border:1px solid #CCCCCC; position:relative;top:-4px; border-top:0;">
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
			<div class="search_nav category_search" id="laptops_search">
			Laptops
			</div>
		</td>
	</tr>
	<tr>  
		<td style="background-color:white; ">
			<div id="search_options_laptops" style="border:1px solid #CCCCCC; position:relative;top:-8px; border-top:0;">
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
			<div class="search_nav category_search" id="phones_search">
				Phones
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="search_options_phones" style="border:1px solid #CCCCCC; position:relative;top:-12px; border-top:0;">
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
</div>

<table style="position:relative; top:20px; float:right;right:10px; border-collapse:collapse; z-index:2;">
<?php 
if ($search_rows!=0 && ($search!='' || $Search == true)){?>
<?php
for ($x=0;$x<count($pageURL_search);$x++){
	if (($x%3)==0){echo "<tr>";}?>
		<td class="comp_select">
		<div class="compBox">
		<a href="compare.php?<?php echo $category[$x]."-c".$pageURL_search[$x]."-gc";?>" >
			<table  style=" margin-top:5px; border-collapse:collapse; width:230px;" >
				<tr>
					<td colspan="2">
						<img src="Pictures/<?php echo ucfirst($category[$x]).$ext[$x].queryULT($select[$x],$category[$x],"id",$choice1_search[$x]);?>" class="compResultImgs" style="margin-left:8px;">
					</td>
					<td colspan="2" >
						<div style="height:100px; background-color:green; width:1px;"></div>
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
	<?php if ((($x-2)%3)==0){echo "</tr>";}
	}?>
</table>
<?php } else {?>
<table style="position:relative; float:right; top:20px; right:10px; z-index:2;">
	<tr>
		<td id="id_search">
			<div>
			<form action="search.php?" method="GET" id="search_form">
				<div style="border-radius:5px; width:640px; display:inline-block;border:1px solid #CCCCCC; background-color:white; height:30px;">
					<div style="display:inline-block; position:relative; left:5px; top:5px;width:17px;">
						<img src="Pictures/Website/search.png" height="14"/>
						<input type="hidden" readonly="true" value="<?php echo $search_choice_chosen;?>"  name="search_choice"/>
					</div>
					<div style="display:inline-block;position:relative; top:3px;">
						<input type="text" name="search" class="search_bar" id="search_bar_long"style="width:611px;height:21px;"placeholder="Search...">
					</div>
				</div>
			</form>
			</div>
		</td>
		<td>
			<div class="search_button" id="search_button">
				Search
			</div>
		</td>
	</tr>
	<?php if ($search!=''){?>
	<tr>
		<td colspan="2" style="color:#4D4D4D; padding:5px; font-size:18px; text-align:center;max-width:640px;">
			Sorry, your search
				<div style="color:#4D4D4D;font-style:italic; font-size:18px; white-space: nowrap; text-overflow: ellipsis; width:735px;white-space: nowrap;
				overflow: hidden;"> '<?php echo $_GET['search'];?>' </div>
				returned no results
		</td>
	</tr>
	<?php } else if ($search_rows==0 && $search=='' && $Search == true){?>
	<tr>
		<td colspan="2" style="color:#4D4D4D; padding:5px; font-size:18px; text-align:center;max-width:640px;">
			Sorry, no comparisons matched your criteria. Click <a href="create.php" style="text-decoration:underline; color:#4D4D4D;">here</a> to make your own comparison.
		</td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

<?php } ?>

<?php
if(($noPages!=0)||($pages_search!=0&&$Search==true)){ ?>
<div class="pageNumberPosSearch" style="position:relative; top:20px; float:right; z-index:1;"><!-- PAGE NUMBERS -->
	<table class="pageNumberTable">
		<tr>
			<td class="pageText">
				Page
			</td>
			<td>
			<div id="table_scroll_horizontal" > 
				<table class="pageNumbersTable2">
					<tr>
					<?php if($Search == false){ ?>
						<?php for($x=0; $x<$noPages; $x++){?>
							<td class="page_numbers" <?php if(($x+1)==$page_number){ echo "id='selected_page_number'"; }?> >
									
								<div class="pageNumbersPadding">
									<a href="<?php echo pageNumbers($x+1)."&search=".$input;?>"><?php echo ($x+1);?></a>
								</div>
							
							</td>
						<?php } ?>
					<?php } else {?>
						<?php for($x=0; $x<$pages_search; $x++){?>
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
<?php } ?>
</div>

<?php require("Incs/footer.inc.php");?>

</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
</body>
</html>