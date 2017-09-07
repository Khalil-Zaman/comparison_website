<div class="results_heading"style="width:968px; top:10px; left:10px; position:relative;">Create A Comparison</div>

<?php
$pic = $Category = $Name = $ext = array();

$x = 0; 
$x2 = 0;
$query = "SELECT * FROM (
	(SELECT `Name`, `category`,`no_comparisons`,`pic_name` AS `pic` FROM `laptops` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 2) UNION
	(SELECT `Name`, `category`,`no_comparisons`,`icon_img` AS `pic` FROM `games` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 2) UNION 
	(SELECT `Name`, `category`,`no_comparisons`,`pic_name` AS `pic` FROM `phones` WHERE 1 ORDER BY `no_comparisons` DESC LIMIT 2)
	) AS search";
$query_run = mysql_query($query);
while($query_row = mysql_fetch_assoc($query_run)){
	$Category[$x2] = ucfirst($query_row['category']);
	$Name[$Category[$x2]][$x] = $query_row['Name'];
	if($Category[$x2] == 'Games'){
		$ext[$Category[$x2]][$x] = '/Icons/';
	} else {
		$ext[$Category[$x2]][$x] = '/';
	}
	$pic[$Category[$x2]][$x] = $query_row['pic']; 
	if(($x+1)==2){
		$x = -1;
	}
	$x++;
	$x2++;
}
?>

<div style="position:relative; top:20px; left:1px; width:978px;">
	<?php $left = 1; for($x=0; $x<count($Category);$x+=2){?>
	<a href="create.php?cat=<?php echo strtolower($Category[$x]);?>-c">
	<div style="float:left; width:317px; left:<?php echo $left*10;?>px; position:relative; border-radius:5px;border:1px solid #CCCCCC; background-color:#F2F2F2;">
		<div class="divCreateHeadings">
			<?php echo $Category[$x];?>
		</div>
			<div style="width:317px;">
				<div style="position:relative; left:10px; width:297px;">
					<table style="border-spacing:0; border-collapse:collapse; background-color:#F2F2F2; color:#4D4D4D;">
						<?php for($x2=0; $x2<2; $x2++){?>
						<tr>
							<td style="text-align:center;">
								<div style="width:296px; height:30px;">
									<div style="font-size:18px; position:relative; top:6px;">
										<?php echo $Name[$Category[$x]][$x2];?>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="text-align:center; position:relative; left:-1px;">
								<img src="Pictures/<?php echo $Category[$x].$ext[$Category[$x]][$x2].$pic[$Category[$x]][$x2];?>" style="width:296px; height:296px; border:1px solid #CCCCCC;background-color:white;"/>
							</td>
						</tr>
						<?php if (($x2+2)==2){ ?>
						<tr>
							<td style="text-align:center; ">
								<div style="width:296px; height:25px;">
									<div style="color:orange; font-size:20px; position:relative; top:6px;">
										VS
									</div>
								</div>
							</td>
						</tr>
						<?php } ?>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</a>
	<?php $left++; } ?>
</div>