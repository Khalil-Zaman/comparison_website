<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
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
@$comparison_category = substr($pageURL, (strpos($pageURL, "new_comparison.php?cat="))+23, (((strpos($pageURL, "-c")))-((strpos($pageURL, "new_comparison.php?cat="))+23)));
@$choice1 = substr($pageURL, (strpos($pageURL, "choice1="))+8, (((strpos($pageURL, "-c1")))-((strpos($pageURL, "choice1="))+8)));
@$choice2 = substr($pageURL, (strpos($pageURL, "choice2="))+8, (((strpos($pageURL, "-c2")))-((strpos($pageURL, "choice2="))+8)));

$query = "SELECT `pageURL` FROM `compare` WHERE (`choice_1`='".$choice1."' AND `choice_2`='".$choice2."') OR (`choice_1`='".$choice2."' AND `choice_2`='".$choice1."') AND `category`='".$comparison_category."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
$check = $query_num_rows;
if ($query_num_rows==1){
	$q_id = $query_row["pageURL"];
	$alreadyComparisonUrl = $q_id;
}
$queryId1 = "SELECT * FROM `".$comparison_category."` WHERE `id`='".$choice1."'";
$query_run1 = mysql_query($queryId1);
$query_rowId1 = mysql_fetch_assoc($query_run1);

$queryId2 = "SELECT * FROM `".$comparison_category."` WHERE `id`='".$choice2."'";
$query_run2 = mysql_query($queryId2);
$query_rowId2 = mysql_fetch_assoc($query_run2);
if ($choice1!=$choice2){
switch($comparison_category){
	case "laptops":
		$field = array (
		"Screen Size",
		"HDD",
		"Resolution",
		"Ram",
		"Bluetooth",
		"Processor",
		"Price"
		);
		$layout = array (
		"height",
		"350"
		);
		$ext = "/";
		$IconPic = "pic_name";
		break;
	case "games":
		$field = array (
		"Genre",
		"Platforms",
		"Released"
		);
		$layout = array (
		"width",
		"350"
		);
		$ext = "/Icons/";
		$IconPic = "icon_img";
		break;
	case "phones":
		$field = array (
		"Name",
		"Brand",
		"Display",
		"Storage",
		"Front Camera",
		"Rear Camera"
		);
		$layout = array (
		"width",
		"350"
		);
		$ext = "/";
		$IconPic = "pic_name";
		break;
	default:
		break;
}

?>

<div style="float:left; position:relative; top:10px; left:10px;">
<table style="position:relative; border:1px solid #CCCCCC; max-width:672px; border-collapse:collapse; border-spacing: 0;"><!-- COMPARISON -->
	<tr>
		<td colspan="3" style="border-bottom:1px solid #CCCCCC;">
			<table style="margin-left:auto; margin-right:auto;">
				<tr>
					<td colspan=2 id="pic" >
						<img class="game_pic" src="Pictures/<?php echo ucfirst($comparison_category)."/".$query_rowId1['pic_name'];?>" width="323"/>
					</td>
					<td colspan="2" >
						<div style="height:<?php echo $height;?>; background-color:green; width:1px; margin-top:-2px;"></div>
					</td>
					<td colspan=2 id="pic" >
						<img class="game_pic" src="Pictures/<?php echo ucfirst($comparison_category)."/".$query_rowId2['pic_name'];?>" width="323"/>
					</td>
				</tr>
				<tr>
					<td colspan="3"style="text-align:center;color:black;"><?php echo $query_rowId1['Name'];?></td>
					<td colspan="3"style="text-align:center;color:black;"><?php echo $query_rowId2['Name'];?></td> 	
				</tr>
			</table>
		</td>
	</tr>
	<tr id="table_detailsNewComparison">
		<td colspan="3" style="height:350px; background-color:white; vertical-align:text-top; border-collapse:collapse;">
			<div id="detail-scroll">
				<table  style="width:671px; border-collapse:collapse; margin-left:-1px; margin-top:-1px; background-color:white; top:0px;" >
					<?php for ($x=0;$x<(count($field));$x++){ ?>
					<tr>
						<td style="width:10%;"> <?php echo $field[$x];?>  </td>
						<td style="width:40%; text-align:center; border-right:1px solid #CCCCCC"><?php echo	$query_rowId1[$field[$x]];?></td>
						<td style="width:40%; text-align:center;"><?php echo $query_rowId1[$field[$x]];?></td>
						<td style="width:10%; text-align:right;"> <?php echo $field[$x];?>  </td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</td>
	</tr>
</table>
</div>

<div style="position:relative; float:right;top:10px; right:10px;">
<div style="position:relative; width:300px; height:250px; background-color:orange;"></div> <!-- MEDIUM RECTANGLE -->
<div style="position:relative; border:1px solid #CCCCCC; top:5px; z-index:4;" class="topSdComparison">
	<table style="position:relative; max-width:372px; border-collapse:collapse; border-spacing: 0;">
		<tr style="height:155px;">
			<td  style="max-height:110px; position:relative;width:288px;padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select sd_highlight" id="sd_<?php echo $x+1;?>">
				<table style="margin-left:auto; margin-right:auto; height:148px;"  >
					<tr>
						<td>
							<img class="sd_comparisons" src="Pictures/<?php echo ucfirst($comparison_category).$ext.$query_rowId1[$IconPic];?>">
						</td>
						<td>
							<div style="height:126px; background-color:green; width:1px;"></div>
						</td>
						<td>
							<img class="sd_comparisons" src="Pictures/<?php echo ucfirst($comparison_category).$ext.$query_rowId2[$IconPic];?>">
						</td>
					</tr>
					<tr class="game_details sd_game_details" style="margin-top:5px; margin-left:-10px;">
						<td colspan="3" class="sd_comp_details" >
							<?php echo $query_rowId1['Name'];?>
						</td>
						<td colspan="3" class="sd_comp_details">
							<?php echo $query_rowId2['Name'];?>
						</td> 
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>


<div style="z-index:1;">
<?php 
if($check == 1){
?>
	<div>
		<a href='compare.php?<?php echo $comparison_category."-c".$alreadyComparisonUrl."-gc"; ?>' style="text-decoration:none;">
			<div id="viewComparison"><span style="font-size:14px;">Comparison already exists. Click this to view the comparison.</span></div>
			<div style="background-color:red; height:10px; width:294px; border-radius:10px;position:relative; right:-4px; top:15px;"></div>
		</a>
	</div>
<?php } else { ?>
	<form method="POST" style="position:relative;">
	<input type="submit" id="saveNewComparison"value="Save" name="SaveToC"/>
	<div style="background-color:red; height:10px; width:294px; border-radius:10px;position:relative; right:-4px; top:15px;"></div>
	</form>
<?php } ?>
</div>

</div>
<?php
		if (isset($_POST["SaveToC"])){
		$query12 = "INSERT INTO `compare`(`pageURL`, `choice_1`, `choice_2`, `time_added`, `user_added_id`, `user_added`, `category`) VALUES (
		'".mysql_real_escape_string($choice1)."&&".mysql_real_escape_string($choice2)."',
		'".mysql_real_escape_string($choice1)."',
		'".mysql_real_escape_string($choice2)."',
		'".time()."',
		'".$_SESSION['user_id']."',
		'".$_SESSION['user_username']."',
		'".$comparison_category."'
		)";
		$query = "SELECT `pageURL` FROM `compare` WHERE (`choice_1`='".$choice1."' AND `choice_2`='".$choice2."') OR (`choice_1`='".$choice2."' AND `choice_2`='".$choice1."') AND `category`='".$comparison_category."'";
		$query_run = mysql_query($query);
		$query_num_rows = mysql_num_rows($query_run);
		$query_row = mysql_fetch_assoc($query_run);
		$check = $query_num_rows;
		if ($query_num_rows==1){
			?>
				<script>
				window.location.replace( <?php echo " '".$url."' "?> );
				</script>
			<?php
		}
		$url = "compare.php?".$comparison_category."-c".$choice1."&&".$choice2."-gc";
		if ($query_run = mysql_query($query12)){
			$queryNoComparisons = "UPDATE `".$comparison_category."` SET `no_comparisons`=`no_comparisons`+1 WHERE `id` IN (".$choice1.",".$choice2.")";
			$queryNoComparisonsRun = mysql_query($queryNoComparisons);
			$queryUser = "UPDATE `users` SET `no_comparisons`=`no_comparisons`+1 WHERE `id`='".$_SESSION['user_id']."'";
			$queryUserRun = mysql_query($queryUser);
			?>
				<script>
				window.location.replace( <?php echo " '".$url."' "?> );
				</script>
			<?php
		} else {
			echo "Failed to save, plese try again later";
		}
	}
} else {
	echo "Both choices cannot be the same";
}	
?>

</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
</body>
</html>
