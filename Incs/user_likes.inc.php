<?php // LIKE
$x = 0;
$like_category = array();
$like_url = array();
$like_left = array();
$like_right = array();
$like_c1_id = array();
$like_c2_id = array();
$like_c1_name = array();
$like_c2_name = array();
$like_extension = array();
$like_pic_field = array();
$query = "SELECT * FROM `likes` WHERE `username`='".$username."' AND `userid`='".$_SESSION["user_id"]."'ORDER BY 'time' DESC ";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows>=21){
	$limit = 21;
} else {
	$limit = $query_num_rows;
}
while(($query_row = mysql_fetch_assoc($query_run)) && ($x<=$limit)){
		$like_category[$x] =  $query_row["category"];
		if ($like_category[$x]=='games'){
			$like_extension[$x] = "/Icons/";
			$like_pic_field[$x] = 'icon_img';
		} else {
			$like_extension[$x] = '/';
			$like_pic_field[$x] = "pic_name";
		}
		$like_url[$x] = $query_row["pageURL"];
		$like_c1_id[$x] = substr($like_url[$x], 0,(strpos($like_url[$x], "&&")));
		$like_c2_id[$x] = substr($like_url[$x], strpos($like_url[$x],"&&")+2);
		$like_c1_name[$x] = queryULT("Name", $like_category[$x], "id",$like_c1_id[$x]);
		$like_c2_name[$x] = queryULT("Name", $like_category[$x], "id",$like_c2_id[$x]);
		$like_left[$x] = $query_row["left"];
		$like_right[$x] = $query_row["right"];
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
		<a class="displayLatestResultsHref" href="<?php echo "compare.php?".$like_category[$x-1]."-c".$like_url[$x-1]."-gc";?>" >
			<table class="displayLatestResultsTable2" >
				<tr>
				<td colspan="2">
					<img src="Pictures/<?php echo $like_category[$x-1].$like_extension[$x-1].queryULT($like_pic_field[$x-1],$like_category[$x-1],"id",$like_c1_id[$x-1]);?>" class="compResultImgs compResultImgLeft">
				</td>
				<td colspan="2" >
					<div class="smallCompLine"></div>
				</td>
				<td  colspan="2">
					<img src="Pictures/<?php echo $like_category[$x-1].$like_extension[$x-1].queryULT($like_pic_field[$x-1],$like_category[$x-1],"id",$like_c2_id[$x-1]);?>" class="compResultImgs">
				</td>
				</tr>
				<tr class="name_details">
					<td class="name_detailsTd1" colspan="6">
						<table class="compDetailsTableUsers">
							<tr>
								<td class="name_details_td"><?php echo $like_c1_name[$x-1];
								if($like_left[$x-1] == 1){
									?>
									<img src="Pictures/Website/green_thumbs_up.png" style="height:15px; top:3px; position:relative;"/>
									<?php
								}
								?></td>
								<td class="name_details_td"><?php echo $like_c2_name[$x-1];
								if($like_right[$x-1] == 1){
									?>
									<img src="Pictures/Website/green_thumbs_up.png" style="height:15px; top:3px; position:relative;"/>
									<?php
								}?></td>
							</tr>
						</table>
					</td>
				</tr>
				<!--
				<tr class="game_details" style="position:absolute; background-color:#CCCCCC; width:247px; margin-left:-8px;">
					<td colspan="3"style="position:relative; background-color:#CCCCCC;width:117.5px; color:black; padding:3px; padding-top:0px;text-align:center;"><?php echo $like_c1_name[$x-1];?></td>
					<td colspan="3"style="position:relative; background-color:#CCCCCC;width:117.5px; color:black; padding:3px; padding-top:0px;text-align:center;"><?php echo $like_c2_name[$x-1];?></td> 
				</tr>
				-->
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
	
<?php } ?>
</table>