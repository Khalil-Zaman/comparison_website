<!--<div class="results_heading"style="width:968px; top:10px; left:10px; position:relative;">Add An Item</div>-->

<?php
$pic = $Category = $Name = $ext = $id = array();
$field = 
array(
'Laptops'=>array(
	"Name",
	"Brand",
	"Screen Size",
	"RAM"), 
"Games"=>array(
	"Name",
	"Genre",
	"Released"),
"Phones"=>array(
	"Name",
	"Brand",
	"Display",
	"Storage",
	"Front Camera",
	"Rear Camera"
	),
"Others"=>array(
	""
	)
);

$x = 0; 
$x2 = 0;
$query = "SELECT * FROM (
	(SELECT `id`,`Name`, `category`,`no_comparisons`,`pic_name` AS `pic` FROM `laptops` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 1) UNION
	(SELECT `id`,`Name`, `category`,`no_comparisons`,`icon_img` AS `pic` FROM `games` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 1) UNION 
	(SELECT `id`,`Name`, `category`,`no_comparisons`,`pic_name` AS `pic` FROM `phones` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 1) UNION
	(SELECT `id`,`Name`, `category`,`no_comparisons`,`pic_name` AS `pic` FROM `others` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 1)
	) AS search";
$query_run = mysql_query($query);
while($query_row = mysql_fetch_assoc($query_run)){
	$Category[$x2] = ucfirst($query_row['category']);
	$Name[$Category[$x2]][$x] = $query_row['Name'];
	$id[$Category[$x2]][$x] = $query_row['id'];
	if($Category[$x2] == 'Games'){
		$ext[$Category[$x2]][$x] = '/Icons/';
	} else {
		$ext[$Category[$x2]][$x] = '/';
	}
	$pic[$Category[$x2]][$x] = $query_row['pic']; 
	if(($x+1)==1){
		$x = -1;
	}
	$x++;
	$x2++;
}
?>
<div style="position:relative; top:20px; left:1px; width:978px;">
	<?php $left = 1; for($x=0; $x<count($Category);$x++){?>
	<a href="Add_item.php?=<?php echo strtolower($Category[$x]);?>-c">
	<div style="float:left; width:235px; left:<?php echo $left*10;?>px; position:relative; border-top-right-radius:5px; border-top-left-radius:5px;border:1px solid #CCCCCC; background-color:white;">
		<div style="text-align:center; border-bottom:1px solid #CCCCCC; font-size:20px; color:#4D4D4D; padding:10px;">
			<?php echo $Category[$x];?>
		</div>
		<div style="padding:10px; width:215px;">
			<table style="border-spacing:0; border-collapse:collapse; color:#4D4D4D;">
				<?php for($x2=0; $x2<1; $x2++){?>
				<tr>
					<td colspan="2" style="text-align:center; position:relative; left:-1px;">
						<img src="Pictures/<?php echo $Category[$x].$ext[$Category[$x]][$x2].$pic[$Category[$x]][$x2];?>" style="width:213px; height:215px; border:1px solid #CCCCCC;background-color:white;"/>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div style="height:250px;">
		<table style="border-top:1px solid #CCCCCC; width:235px; color:#4D4D4D; border-collapse:collapse; border-spacing:0; background-color:white;">
			<?php for($x2=0; $x2<count($field[$Category[$x]]); $x2++){ ?>
			<tr rowspan="2">
				<td style="width:100px; max-width:100px; vertical-align:text-top; padding:5px;">
					<?php echo $field[$Category[$x]][$x2];?>
				</td>
				<td style="padding:5px; max-width:115px; width:115px;">
					<?php echo queryULT($field[$Category[$x]][$x2],
					$Category[$x],"id",
					$id[$Category[$x]][0]);?>
				</td>
			</tr>
			<?php } ?>
		</table>
		</div>
		<!--
		<table style="border-top:1px solid #CCCCCC; width:235px; color:">
			<tr>
				<td style="width:100%;">
					<table style="border-collapse:collapse; border-spacing:0; background-color:white; width:100%;">
					<?php for($x2=0; $x2<count($field[$Category[$x]]); $x2++){ ?>
					<tr rowspan="2">
						<td style="width:100px; max-width:100px; vertical-align:text-top; padding-left:5px; padding-bottom:3px; padding-right:3px;">
							<?php echo $field[$Category[$x]][$x2];?>
						</td>
						<td>
							<?php echo queryULT($field[$Category[$x]][$x2],
							$Category[$x],"id",
							$id[$Category[$x]][0]);?>
						</td>
					</tr>
					<?php } ?>
					</table>
				</td>
			</tr>
		</table>
		-->
	</div>
	</a>
	<?php $left++; } ?>
</div>


<!-- BENEATH 
<div style="position:relative; top:20px; left:1px; width:978px;">
	<?php $left = 1; for($x=0; $x<count($Category);$x++){?>
	<a href="Add_item.php?=<?php echo strtolower($Category[$x]);?>-c">
	<div style="float:left; width:235px; left:<?php echo $left*10;?>px; position:relative; border-radius:5px;border:1px solid #CCCCCC; background-color:#F2F2F2;">
		<div style="text-align:center; border-bottom:1px solid #CCCCCC; font-size:20px; color:#4D4D4D; padding:10px;">
			<?php echo $Category[$x];?>
		</div>
		<div style="padding:10px; width:215px;">
			<table style="border-spacing:0; border-collapse:collapse; background-color:#F2F2F2; color:#4D4D4D;">
				<?php for($x2=0; $x2<1; $x2++){?>
				<tr>
					<td colspan="2" style="text-align:center; position:relative; left:-1px;">
						<img src="Pictures/<?php echo $Category[$x].$ext[$Category[$x]][$x2].$pic[$Category[$x]][$x2];?>" style="width:213px; height:215px; border:1px solid #CCCCCC;background-color:white;"/>
					</td>
				</tr>
				<tr>
					<td>
						<table style="border-collapse:collapse; border-spacing:0; background-color:white; border:1px solid #CCCCCC;">
						<?php for($x2=0; $x2<count($field[$Category[$x]]); $x2++){ ?>
						<tr rowspan="2">
							<td style="width:100px; max-width:100px; vertical-align:text-top;">
								<?php echo $field[$Category[$x]][$x2];?>
							</td>
							<td>
								<?php echo queryULT($field[$Category[$x]][$x2],
								$Category[$x],"id",
								$id[$Category[$x]][0]);?>
							</td>
						</tr>
						<?php } ?>
						</table>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	</a>
	<?php $left++; } ?>
</div>
-->
<!--
<div style="position:relative; top:20px; left:1px; width:978px;">
	<?php $left = 1; for($x=0; $x<count($Category);$x++){?>
	<a href="Add_item.php?=<?php echo strtolower($Category[$x]);?>-c">
	<div style="width:235px; left:<?php echo $left*10;?>px; position:relative; border-radius:5px;border:1px solid #CCCCCC; background-color:#F2F2F2;">
		<div style="text-align:center; border-bottom:1px solid #CCCCCC; font-size:20px; color:#4D4D4D; padding:10px;">
			<?php echo $Category[$x];?>
		</div>
		<div style="padding:10px; width:215px;">
			<table style="border-spacing:0; border-collapse:collapse;  color:#4D4D4D;">
				<tr  style="border-spacing:0; border-collapse:collapse;">
					<td  style="border-spacing:0; border-collapse:collapse; position:relative; left:-1px; top:-1px; ">
						<table style="border-spacing:0; border-collapse:collapse; background-color:#F2F2F2; color:#4D4D4D;">
							<?php for($x2=0; $x2<1; $x2++){?>
							<tr>
								<td colspan="2" style="text-align:center; position:relative; left:-1px;">
									<img src="Pictures/<?php echo $Category[$x].$ext[$Category[$x]][$x2].$pic[$Category[$x]][$x2];?>" style="width:213px; height:215px; border:1px solid #CCCCCC;background-color:white;"/>
								</td>
							</tr>
							<?php } ?>
						</table>
					</td>
					<td style="position:relative;border:1px solid #CCCCCC; border-collapse:collapse; border-spacing:0; vertical-align:text-top;">
						<table style="border-collapse:collapse; border-spacing:0; background-color:white; border:1px solid #CCCCCC; height:223px;">
						<?php for($x2=0; $x2<count($field[$Category[$x]]); $x2++){ ?>
						<tr rowspan="2" style="">
							<td style="width:150px; max-width:150px; vertical-align:text-top;">
								<?php echo $field[$Category[$x]][$x2];?>
							</td>
							<td style=" vertical-align:text-top;">
								<?php echo queryULT($field[$Category[$x]][$x2],
								$Category[$x],"id",
								$id[$Category[$x]][0]);?>
							</td>
						</tr>
						<?php } ?>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
	</a>
	<?php $left++; } ?>
</div>
-->