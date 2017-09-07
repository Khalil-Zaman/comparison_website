<?php
$x=0;
$category = array();
$pageURLArray = array();
$choice1 = array();
$choice2 = array();
$choice1_name = array();
$choice2_name = array();
$extensions = array();
$extensions = array();
$pic_field = array();
$select = "`pageURL`,`choice_1`,`choice_2`,`time_added`,`id`,`category`";
$query = "
SELECT ".$select." FROM `compare` WHERE `user_added`='".$username."' AND `user_added_id`='".$_SESSION["user_id"]."' ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows>=21){
	$limit = 21;
} else {
	$limit = $query_num_rows;
}
while(($query_row = mysql_fetch_assoc($query_run)) && ($x<=$limit)){
	$category[$x] = $query_row['category'];
	if ($category[$x]=='games'){
		$extension[$x] = "/Icons/";
		$pic_field[$x] = 'icon_img';
	} else {
		$extension[$x] = '/';
		$pic_field[$x] = "pic_name";
	}
	$choice1[$x] =  $query_row["choice_1"];
	$choice2[$x] =  $query_row["choice_2"];
	$choice1_name[$x] = queryULT("Name", $category[$x], "id",$choice1[$x]);
	$choice2_name[$x] = queryULT("Name", $category[$x], "id",$choice2[$x]);
	$pageURLArray[$x] = $query_row["pageURL"];
	$x++;
}
?>
<table style="position:relative; border-collapse:collapse; border-spacing: 0; top:-1px;"> <!-- LIKES -->
<?php
$x = 1;
while($x<=$limit){
	if(((($x-1)%3)==0)){
		echo "<tr>";
	}
	?>
		<td class="comp_select">
		<div class="compBox">
		<a class="displayLatestResultsHref" href="<?php echo "compare.php?".$category[$x-1]."-c".$pageURLArray[$x-1]."-gc";?>" >
			<table class="displayLatestResultsTable2">
				<tr>
				<td colspan="2">
					<img src="Pictures/<?php echo $category[$x-1].$extension[$x-1].queryULT($pic_field[$x-1],$category[$x-1],"id",$choice1[$x-1]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo $category[$x-1].$extension[$x-1].queryULT($pic_field[$x-1],$category[$x-1],"id",$choice2[$x-1]);?>" class="compResultImgs">
				</td>
				</tr>
				<tr class="name_details">
					<td class="name_detailsTd1" colspan="6">
						<table class="compDetailsTableUsers">
							<tr>
								<td class="name_details_td"><?php echo $choice1_name[$x-1];?></td>
								<td class="name_details_td"><?php echo $choice2_name[$x-1];?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</a>	
		</div>
		</td>
	<?php
	$x++;
	if(((($x-1)%3)==0)){
		echo "</tr>";
	}
?>
	
<?php }?>
</table>