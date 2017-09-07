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
<div id="content" style="padding-bottom:400px;">

<?php
$basicArray = array("Games", "Laptops","Phones" );
$field["games"]=array(
	"Name",
	"Platforms",
	"Genre",
	"Source",
	"Picture Source"
);
$field["laptops"]=array(
	"Name",
	"Brand",
	"Screen Size",
	"HDD",
	"Resolution",
	"Ram",
	"Bluetooth",
	"Processor",
	"Price",
	"Source",
	"Picture Source"
);
$field["phones"]=array(
	"Name",
	"Brand",
	"Display",
	"Internal Storage",
	"Front Camera",
	"Rear Camera",
	"Source",
	"Picture Source"
);

$x = 0;
$query = "SELECT * FROM ( 
	SELECT `id`,`time_added`,`category`,`verified`,`icon_img` AS `pic_name` FROM `games` 	WHERE `verified`='0' AND `delete`='0' UNION
	SELECT `id`,`time_added`,`category`,`verified`,`pic_name` FROM `laptops`	WHERE `verified`='0' AND `delete`='0' UNION
	SELECT `id`,`time_added`,`category`,`verified`,`pic_name` FROM `phones`	WHERE `verified`='0' AND `delete`='0') AS search ORDER BY `time_added` ASC" ;
$query_run = mysql_query($query);
while ($query_row = mysql_fetch_assoc($query_run)){
	$cat = $query_row["category"];
	$id[$x] = $query_row['id'];
	$category[$x] = $query_row["category"];
	$pic[$x] = $query_row['pic_name'];
	$time = time()- $query_row['time_added'];
	$time_added[$x] = date("n\M j\d G\h i\m s\s",$time);
	if($category[$x]=="games"){
		$extension[$x]="/Icons/";
	} else {
		$extension[$x]="/";
	}
	
	$querySub = "SELECT * FROM `".$cat."` WHERE `id`='".$id[$x]."'";
	$query_runSub = mysql_query($querySub);
	$query_rowSub = mysql_fetch_assoc($query_runSub);
	for($x2=0; $x2<count($field[$category[$x]]); $x2++){
		$options[$category[$x]][$id[$x]][$x2] = $query_rowSub[$field[$category[$x]][$x2]];
		// Eg. Options -> Laptops -> id=4 -> fieldinputted
	}
	$x++;	
}
?>

<div style="position:absolute;">
	<div style="position:fixed; z-index:1;">
		<div id="verifyBox" style="position:relative; top:10px; left:9px;">
		<div id="loadingVerify" style="position:relative; top:50px; left:400px;">
			<div class="bubblingG">
			<span id="bubblingG_1">
			</span>
			<span id="bubblingG_2">
			</span>
			<span id="bubblingG_3">
			</span>
			</div>
		</div>
		<div id="verifyInfo">
		</div>
		</div>
	</div>
</div>

<table class="verifyTable">
	<?php for($x=0; $x<count($id); $x++){ ?>
	<?php if(($x)%5==0){?>
	<tr style="border-collapse:collapse; border-spacing:0; border:1px solid #CCCCCC;">
	<?php } ?>
		<td style="border-collapse:collapse; border-spacing:0; border:1px solid #CCCCCC;">
			<table style="border-spacing:0; border-collapse:collapse; background-color:#FFFFFF;">
				<tr style="border-collapse:collapse; border-spacing:0;">
					<td style="border-collapse:collapse; border-spacing:0;">
						<table style="border-collapse:collapse; border-spacing:0;" class="pic_select">
							<input type="hidden" readonly="true" value="<?php echo $category[$x];?>"  class="verifyClickCategory"/>
							<input type="hidden" readonly="true" value="<?php echo $id[$x];?>"  class="verifyClickId"/>
							<input type="hidden" readonly="true" id="<?php echo $category[$x].$id[$x];?>"/>
							<tr style="border-collapse:collapse; border-spacing:0;">
								<td style="border-collapse:collapse; border-spacing:0;">
									<a href="<?php echo "admin_verifyExtra.php?".$category[$x]."-".$id[$x]."-c";?>" target="_blank">
										<img src="<?php echo "Pictures/".ucfirst($category[$x]).$extension[$x].$pic[$x];?>" class="pic_verify">
									</a>
								</td>
							</tr>
							<tr style="border-collapse:collapse; border-spacing:0;">
								<td class="verifyTimeAdded">
									<?php echo $time_added[$x];?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
			<?php if(($x+1)%5==0){?>
			<tr style="border-collapse:collapse; border-spacing:0;">
			<?php } ?>
		<?php } ?>
		</td>
	</tr>
</table>

<div id="test1"></div>

</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/verify.js"></script>
</body>
</html>